<?php
/*
 * This file is part of the classroom-ddd.
 *
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Infrastructure\ReadModel\Repository;


use App\Domain\Student\Model\StudentId;
use App\Infrastructure\Entity\StudentView;

interface StudentViews
{
    public function add(StudentView $studentView): void;

    public function get(string $studentId): StudentView;

    public function ofId(string $studentId): ?StudentId;

    /**
     * @return array|StudentView[]
     */
    public function all(): array;
}
