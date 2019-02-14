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

use App\Domain\Student\Exception\StudentCardNumberAlreadyRegisteredException;
use App\Domain\Student\Exception\StudentIdAlreadyRegisteredException;
use App\Domain\Student\Model\Student;
use App\Domain\Student\Repository\Students;
use App\Domain\Student\Service\ChecksUniqueStudent;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\CommandHandlerInterface;

final class AddStudentHandler implements CommandHandlerInterface
{
    /**
     * @var Students
     */
    private $students;
    /**
     * @var ChecksUniqueStudent
     */
    private $checksUniqueStudent;

    public function __construct(Students $students, ChecksUniqueStudent $checksUniqueStudent)
    {
        $this->students = $students;
        $this->checksUniqueStudent = $checksUniqueStudent;
    }

    public function __invoke(AddStudent $command)
    {
        if ($this->students->find($command->studentId())) {
            throw StudentIdAlreadyRegisteredException::withStudentId($command->studentId()->toString());
        }

        if ($this->checksUniqueStudent->ofCardNumber($command->cardNumber())) {
            throw StudentCardNumberAlreadyRegisteredException::withStudentCardNumber($command->cardNumber()->toString());
        }

        $student = Student::add(
            $command->studentId(),
            $command->cardNumber(),
            $command->person()
        );

        $this->students->save($student);
    }
}
