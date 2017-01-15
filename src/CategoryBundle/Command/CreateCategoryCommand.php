<?php

namespace CategoryBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;


/**
 * Class CreateCategoryCommand
 * @package CategoryBundle\Command
 */
class CreateCategoryCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('category:create')
            ->setDescription('Create new category')
            ->setHelp('This command allow you to create category')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the category');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $managerCategory = $this->getContainer()->get('manage.category');
        $managerCategory->create($input->getArgument('name'));
        $output->writeln('Category name: ' . $input->getArgument('name'));
    }
}
