<?php
/*
 * This file is part of the classroom-ddd.
 *
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Infrastructure\Services\Domain;


use App\Domain\Common\Model\Username;
use App\Domain\Professor\Model\ProfessorId;
use App\Domain\Professor\Service\ChecksUniqueProfessor;
use App\Infrastructure\Entity\ProfessorView;
use App\Infrastructure\ReadModel\Repository\ProfessorViews;

class ChecksUniqueProfessorFromReadModel implements ChecksUniqueProfessor
{
    /**
     * @var ProfessorViews
     */
    private $professorViews;

    public function __construct(ProfessorViews $professorViews)
    {
        $this->professorViews = $professorViews;
    }

    public function ofUsername(Username $username): ?ProfessorId
    {
        $professor = $this->professorViews->ofUsername($username);

        if ($professor instanceof ProfessorView) {
            return ProfessorId::fromString($professor->getId());
        }

        return null;
    }
}
