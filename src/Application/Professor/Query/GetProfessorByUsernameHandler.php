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

namespace App\Application\Professor\Query;

use App\Infrastructure\ReadModel\Repository\ProfessorViews;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\QueryHandlerInterface;

class GetProfessorByUsernameHandler implements QueryHandlerInterface
{
    /**
     * @var ProfessorViews
     */
    private $professorViews;

    public function __construct(ProfessorViews $professorViews)
    {
        $this->professorViews = $professorViews;
    }

    public function __invoke(GetProfessorByUsername $query)
    {
        $username = $query->username()->toString();

        return $this->professorViews->ofUsername($username);
    }
}
