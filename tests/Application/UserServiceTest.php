<?php

namespace App\Tests\Service;

use App\Application\UserService;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\DBAL\Exception as DBALException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserServiceTest extends TestCase
{
    private $entityManager;
    private $userRepository;
    private $userService;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->userService = new UserService($this->userRepository, $this->entityManager);
    }

    public function testCreateUserSuccessfully(): void
    {
        $data = [
            'name' => 'John',
            'lastname' => 'Doe',
            'phonenumber' => '1234567890',
            'dateOfBirth' => '1980-01-01',
            'dateOfRegistration' => '2023-01-01'
        ];

        $this->entityManager->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(User::class));

        $this->entityManager->expects($this->once())
            ->method('flush');

        $result = $this->userService->createUser($data);

        $this->assertEquals(JsonResponse::HTTP_CREATED, $result);
    }

    public function testCreateUserGeneralException(): void
    {
        $data = [
            'name' => 'John',
            'lastname' => 'Doe',
            'phonenumber' => '1234567890',
            'dateOfBirth' => '1980-01-01',
            'dateOfRegistration' => '2023-01-01'
        ];

        $this->entityManager->expects($this->once())
            ->method('persist')
            ->will($this->throwException(new \Exception()));

        $result = $this->userService->createUser($data);

        $this->assertEquals(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, $result);
    }
}
