<?php

declare(strict_types=1);

/*
 * This file is part of the `classroom-ddd` project.
 *
 * (c) Aula de Software Libre de la UCO <aulasoftwarelibre@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Infrastructure\Repository;

use App\Domain\Student\Exception\StudentIdDoesNotExistsException;
use App\Domain\Student\Model\StudentId;
use App\Infrastructure\Entity\StudentView;
use App\Infrastructure\ReadModel\Repository\StudentViews;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StudentView|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentView|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentView[]    findAll()
 * @method StudentView[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentViewsRepository extends ServiceEntityRepository implements StudentViews
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StudentView::class);
    }

    public function add(StudentView $studentView): void
    {
        $this->_em->persist($studentView);
        $this->_em->flush();
    }

    public function get(string $studentId): StudentView
    {
        $studentView = $this->ofId($studentId);

        if (!$studentView instanceof StudentView) {
            throw StudentIdDoesNotExistsException::withStudentId($studentId);
        }

        return $studentView;
    }

    public function ofId(string $studentId): ?StudentId
    {
        return $this->find($studentId);
    }

    /**
     * {@inheritdoc}
     */
    public function all(): array
    {
        return $this->findAll();
    }
}
