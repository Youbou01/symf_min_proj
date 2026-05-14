<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-admin',
    description: 'Create an admin user.',
)]
class CreateAdminUserCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Admin email')
            ->addArgument('password', InputArgument::REQUIRED, 'Admin password')
            ->addOption('nom', null, InputOption::VALUE_REQUIRED, 'Nom', 'Admin')
            ->addOption('prenom', null, InputOption::VALUE_REQUIRED, 'Prénom', 'Admin')
            ->addOption('tel', null, InputOption::VALUE_REQUIRED, 'Téléphone', '00000000')
            ->addOption('cin', null, InputOption::VALUE_REQUIRED, 'CIN', '00000000');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = trim((string) $input->getArgument('email'));

        if ($email === '') {
            $io->error('Email is required.');
            return Command::FAILURE;
        }

        $existingUser = $this->entityManager->getRepository(User::class)
            ->findOneBy(['Emaillogin' => $email]);

        if ($existingUser !== null) {
            $io->error(sprintf('User "%s" already exists.', $email));
            return Command::FAILURE;
        }

        $user = new User();
        $user->setEmaillogin($email);
        $user->setNom((string) $input->getOption('nom'));
        $user->setPreNom((string) $input->getOption('prenom'));
        $user->setTel((string) $input->getOption('tel'));
        $user->setCIN((string) $input->getOption('cin'));
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            (string) $input->getArgument('password')
        ));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success(sprintf('Admin user created: %s', $email));

        return Command::SUCCESS;
    }
}
