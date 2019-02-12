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

namespace App\Application\Professor\Command;

use App\Domain\Professor\Exception\ProfessorUsernameAlreadyRegisteredException;
use App\Domain\Professor\Model\Professor;
use App\Domain\Professor\Repository\Professors;
use App\Domain\Professor\Service\ChecksUniqueProfessor;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\CommandHandlerInterface;

final class AddProfessorHandler implements CommandHandlerInterface
{
    /**
     * @var Professors
     */
    private $professors;
    /**
     * @var \App\Domain\Professor\Service\ChecksUniqueProfessor
     */
    private $checksUniqueProfessor;

    public function __construct(Professors $professors, ChecksUniqueProfessor $checksUniqueProfessor)
    {
        $this->professors = $professors;
        $this->checksUniqueProfessor = $checksUniqueProfessor;
    }

    public function __invoke(AddProfessor $command)
    {
        if ($this->checksUniqueProfessor->ofUsername($command->username())) {
            throw ProfessorUsernameAlreadyRegisteredException::withUsername($command->username()->toString());
        }

        $professor = Professor::add(
            $command->professorId(),
            $command->username(),
            $command->password(),
            $command->role()
        );

        $this->professors->save($professor);
    }
}
