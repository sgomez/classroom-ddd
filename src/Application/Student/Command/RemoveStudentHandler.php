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

namespace App\Application\Student\Command;

use App\Domain\Student\Exception\StudentIdDoesNotExistsException;
use App\Domain\Student\Model\StudentInterface;
use App\Domain\Student\Repository\Students;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\CommandHandlerInterface;

class RemoveStudentHandler implements CommandHandlerInterface
{
    /**
     * @var Students
     */
    private $students;

    public function __construct(Students $students)
    {
        $this->students = $students;
    }

    public function __invoke(RemoveStudent $command)
    {
        $student = $this->students->get($command->studentId());

        if (!$student instanceof StudentInterface) {
            throw StudentIdDoesNotExistsException::withStudentId($command->studentId()->toString());
        }

        $student->remove();

        // TODO: remove from groups

        $this->students->save($student);
    }
}
