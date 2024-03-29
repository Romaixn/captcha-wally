<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\ImageFinder;
use App\Service\ImageSplitter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:split-image',
    description: 'Split given image in multiple',
)]
class SplitImageCommand extends Command
{
    public function __construct(
        private readonly ImageFinder $imageFinder,
        private readonly ImageSplitter $imageSplitter,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('image', InputArgument::OPTIONAL, 'Name of image to split (ie: wally-1.png)')
            ->addArgument('cols', InputArgument::OPTIONAL, 'The number of columns', 4)
            ->addArgument('rows', InputArgument::OPTIONAL, 'The number of rows', 4)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Image splitter');

        $image = (string) $input->getArgument('image');
        $cols = (int) $input->getArgument('cols');
        $rows = (int) $input->getArgument('rows');
        if (!empty($image)) {
            $io->text(' > <info>Splitting image</info>: '.$image);
        } else {
            /** @var string $image */
            $image = $io->ask('Image to split (ie: wally-1.png)', 'wally-1.png');
            $cols = (int) $io->ask('The number of columns', (string) $cols);
            $rows = (int) $io->ask('The number of rows', (string) $rows);
        }

        $imagePath = $this->imageFinder->getImageUrl($image);

        $this->imageSplitter->split($imagePath, $cols, $rows);

        $io->success('Image split successfully !');

        return Command::SUCCESS;
    }
}
