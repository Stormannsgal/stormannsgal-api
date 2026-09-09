<?php declare(strict_types=1);

namespace Stormannsgal\Cli;

use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Generator\ClassNameGenerator;
use Doctrine\Migrations\Tools\Console\Command\DoctrineCommand;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use function preg_match;
use function sprintf;
use function trim;

final class SuffixableClassNameGenerator extends ClassNameGenerator
{
    public function generateClassName(string $namespace, string $suffix = ''): string
    {
        $className = parent::generateClassName($namespace);

        if ($suffix === '') {
            return $className;
        }

        return $className . '_' . $suffix;
    }
}

final class GenerateMigrationCommand extends DoctrineCommand
{
    public function __construct(DependencyFactory $dependencyFactory)
    {
        parent::__construct($dependencyFactory, 'migrations:generate');
    }

    protected function configure(): void
    {
        $this
            ->setAliases(['generate'])
            ->setDescription('Generate a blank migration class.')
            ->addArgument(
                'suffix',
                InputArgument::OPTIONAL,
                'Optional suffix appended to the migration class name (e.g. "CreateXY" -> "Version20260909202622_CreateXY")',
            )
            ->addOption(
                'namespace',
                null,
                InputOption::VALUE_REQUIRED,
                'The namespace to use for the migration (must be in the list of configured namespaces)',
            )
            ->setHelp(<<<'EOT'
The <info>%command.name%</info> command generates a blank migration class:

    <info>%command.full_name%</info>

You can append an optional suffix to the generated class name:

    <info>%command.full_name% CreateXY</info>

EOT);

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $suffix = trim((string) $input->getArgument('suffix'));

        if ($suffix !== '' && preg_match('/^[A-Za-z0-9_]+$/', $suffix) !== 1) {
            throw new InvalidArgumentException(sprintf(
                'Invalid migration suffix "%s". Allowed characters: a-z, A-Z, 0-9 and underscore.',
                $suffix,
            ));
        }

        $namespace = $this->getNamespace($input, $output);

        $fqcn = $this->getDependencyFactory()
            ->getClassNameGenerator()
            ->generateClassName($namespace, $suffix);

        $path = $this->getDependencyFactory()
            ->getMigrationGenerator()
            ->generateMigration($fqcn);

        $this->io->text([
            sprintf('Generated new migration class to "<info>%s</info>"', $path),
            '',
            sprintf(
                'To run just this migration for testing purposes, you can use <info>migrations:execute --up \'%s\'</info>',
                $fqcn,
            ),
            '',
            sprintf(
                'To revert the migration you can use <info>migrations:execute --down \'%s\'</info>',
                $fqcn,
            ),
            '',
        ]);

        return 0;
    }
}