<?php
declare(strict_types=1);
namespace Extcode\Contacts\Updates;

use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\DataHandling\SlugHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Updates\ChattyInterface;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

/**
 * Generate slugs for empty path_segments
 */
class SlugUpdater implements UpgradeWizardInterface, ChattyInterface
{
    const IDENTIFIER = 'contactsSlugUpdater';
    const TABLE_NAME_CONTACT = 'tx_contacts_domain_model_contact';
    const TABLE_NAME_COMPANY = 'tx_contacts_domain_model_company';

    /**
     * Return the identifier for this wizard
     * This should be the same string as used in the ext_localconf class registration
     *
     * @return string
     */
    public function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return 'Updates slug field "path_segment" of EXT:contacts records';
    }

    /**
     * Return the description for this wizard
     *
     * @return string
     */
    public function getDescription(): string
    {
        return 'TYPO3 includes native URL handling. Every event record has its own speaking URL path called "slug" which can be edited in TYPO3 Backend. However, it is necessary that all contacts have a URL pre-filled. This is done by evaluating the title.';
    }

    /**
     * Checks if an update is needed
     *
     * @return bool Whether an update is needed (TRUE) or not (FALSE)
     */
    public function updateNecessary(): bool
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable(self::TABLE_NAME_CONTACT);
        $queryBuilder->getRestrictions()->removeAll();
        $elementCountContact = $queryBuilder->count('uid')
            ->from(self::TABLE_NAME_CONTACT)
            ->where(
                $queryBuilder->expr()->orX(
                    $queryBuilder->expr()->eq('path_segment', $queryBuilder->createNamedParameter('', \PDO::PARAM_STR)),
                    $queryBuilder->expr()->isNull('path_segment')
                )
            )
            ->execute()->fetchColumn(0);

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable(self::TABLE_NAME_COMPANY);
        $queryBuilder->getRestrictions()->removeAll();
        $elementCountCompany = $queryBuilder->count('uid')
            ->from(self::TABLE_NAME_COMPANY)
            ->where(
                $queryBuilder->expr()->orX(
                    $queryBuilder->expr()->eq('path_segment', $queryBuilder->createNamedParameter('', \PDO::PARAM_STR)),
                    $queryBuilder->expr()->isNull('path_segment')
                )
            )
            ->execute()->fetchColumn(0);

        return (bool)($elementCountContact + $elementCountCompany);
    }

    /**
     * Performs the database update
     *
     * @return bool
     */
    public function executeUpdate(): bool
    {
        $this->updatePathSegment(self::TABLE_NAME_CONTACT);
        $this->updatePathSegment(self::TABLE_NAME_COMPANY);

        return true;
    }

    /**
     * Returns an array of class names of Prerequisite classes
     *
     * @return string[]
     */
    public function getPrerequisites(): array
    {
        return [];
    }

    /**
     * Setter injection for output into upgrade wizards
     *
     * @param OutputInterface $output
     */
    public function setOutput(OutputInterface $output): void
    {
        $this->output = $output;
    }

    /**
     * @param string $tableName
     *
     * @return bool
     */
    protected function updatePathSegment(string $tableName): bool
    {
        $slugHelper = GeneralUtility::makeInstance(
            SlugHelper::class,
            $tableName,
            'path_segment',
            $GLOBALS['TCA'][$tableName]['columns']['path_segment']['config']
        );

        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable($tableName);
        $queryBuilder = $connection->createQueryBuilder();
        $queryBuilder->getRestrictions()->removeAll();
        $statement = $queryBuilder->select('*')
            ->from($tableName)
            ->where(
                $queryBuilder->expr()->orX(
                    $queryBuilder->expr()->eq('path_segment', $queryBuilder->createNamedParameter('', \PDO::PARAM_STR)),
                    $queryBuilder->expr()->isNull('path_segment')
                )
            )
            ->execute();
        while ($record = $statement->fetch()) {
            $slug = $slugHelper->generate($record, $record['pid']);

            $queryBuilder = $connection->createQueryBuilder();
            $queryBuilder->update($tableName)
                ->where(
                    $queryBuilder->expr()->eq(
                        'uid',
                        $queryBuilder->createNamedParameter($record['uid'], \PDO::PARAM_INT)
                    )
                )
                ->set('path_segment', $slug);
            $queryBuilder->getSQL();
            $queryBuilder->execute();
        }

        return true;
    }
}
