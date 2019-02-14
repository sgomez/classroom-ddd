<?php
/*
 * This file is part of the classroom-ddd.
 *
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Domain\Student\Repository;


use App\Domain\Student\Exception\StudentIdDoesNotExistsException;
use App\Domain\Student\Model\StudentId;
use App\Domain\Student\Model\StudentInterface;

interface Students
{
    /**
     * @param StudentInterface $student
     */
    public function save(StudentInterface $student): void;

    /**
     * @param StudentId $studentId
     *
     * @throws StudentIdDoesNotExistsException
     *
     * @return StudentInterface
     */
    public function get(StudentId $studentId): StudentInterface;

    /**
     * @param StudentId $studentId
     *
     * @return StudentInterface|null
     */
    public function find(StudentId $studentId): ?StudentInterface;

    /**
     * @return StudentId
     */
    public function nextIdentity(): StudentId;
}
