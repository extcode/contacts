<?php

namespace Extcode\Contacts\Command;

/*
 * This file is part of the package extcode/cart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class GeocodeCommand extends Command
{

    /**
     * @var string
     */
    protected $tableName = 'tx_contacts_domain_model_address';

    /**
     * @var string
     */
    protected $googleMapsApiKey = '';

    protected function configure()
    {
        $this->setDescription('Geocode addresses of contact extension');
        $this->setHelp('Try to geocode all addresses of contact extension, where latitude and longitude are not set. It uses the google maps API. A valid API key is required!');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $extensionConfiguration = new \TYPO3\CMS\Core\Configuration\ExtensionConfiguration();
        $contactsConfiguration = $extensionConfiguration->get('contacts');

        $this->googleMapsApiKey = $contactsConfiguration['googleMapsApiKey'];
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('');

        if (empty($this->googleMapsApiKey)) {
            $output->writeln('ApiKey is missing!');
            $output->writeln('');
            return;
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable($this->tableName);

        $addressCountAll = $queryBuilder
            ->count('uid')
            ->from($this->tableName)
            ->where(
                $queryBuilder->expr()->eq('deleted', 0)
            )
            ->execute()
            ->fetchColumn(0);

        $addresses = $queryBuilder
            ->select('uid', 'lat', 'lon', 'street', 'street_number', 'zip', 'city')
            ->from($this->tableName)
            ->where(
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->eq('deleted', 0),
                    $queryBuilder->expr()->eq('lat', 0),
                    $queryBuilder->expr()->eq('lon', 0)
                )
            )
            ->execute()
            ->fetchAll();

        $cntAddressesToProcess = count($addresses);
        $addressesProcessed = $addressCountAll - $cntAddressesToProcess;

        if ($cntAddressesToProcess === 0) {
            $output->writeln('Nothing to do here.');
            $output->writeln('');
            return;
        }

        $progress = new ProgressBar($output, $addressCountAll);

        $progress->start();
        $progress->advance($addressesProcessed);

        $posResult = 0;
        $negResult = 0;

        foreach ($addresses as $address) {
            $addressToProcess = implode(' ', [
                $address['street'],
                $address['street_number'],
                ',' . $address['zip'],
                ',' . $address['city'],
            ]);
            [$lat, $lng] = $this->geocode($addressToProcess);

            if ($lat && $lng) {
                $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
                    ->getQueryBuilderForTable($this->tableName);
                $queryBuilder
                    ->update($this->tableName)
                    ->where(
                        $queryBuilder->expr()->eq('uid', $address['uid'])
                    )
                    ->set('lat', $lat)
                    ->set('lon', $lng)
                    ->execute();
                $posResult++;
            } else {
                $negResult++;
            }

            $progress->advance();
        }

        $output->writeln($posResult . ' addresses have been updated.');
        $output->writeln($negResult . ' addresses could not be updated.');
        $output->writeln('');

        $progress->finish();
    }

    /**
     * @param string $address
     *
     * @return array
     */
    protected function geocode(string $address): array
    {
        $address = urlencode($address);
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?key=' . $this->googleMapsApiKey . "&address={$address}";

        $resp_json = file_get_contents($url);
        $resp = json_decode($resp_json, true);

        if ($resp['status'] === 'OK') {
            $lat = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : '';
            $lng = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : '';

            if ($lat && $lng) {
                return [$lat, $lng];
            }
        }

        return [0, 0];
    }
}
