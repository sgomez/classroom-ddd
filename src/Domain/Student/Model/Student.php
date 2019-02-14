<?php
/*
 * This file is part of the classroom-ddd.
 *
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Domain\Student\Model;


use App\Domain\Common\Model\Person;
use App\Domain\Common\Model\PersonalData;
use App\Domain\Student\Event\StudentWasAdded;
use App\Domain\Student\Event\StudentWasRemoved;
use AulaSoftwareLibre\DDD\BaseBundle\Domain\ApplyMethodDispatcherTrait;
use Prooph\EventSourcing\AggregateRoot;

final class Student extends AggregateRoot implements StudentInterface
{
    use ApplyMethodDispatcherTrait;

    /**
     * @var StudentId
     */
    private $studentId;

    /**
     * @var StudentCardNumber
     */
    private $cardNumber;

    /**
     * @var Person
     */
    private $person;

    /**
     * @var PersonalData
     */
    private $personalData;

    public static function add(
        StudentId $studentId,
        StudentCardNumber $cardNumber,
        Person $person,
        PersonalData $personalData
    ): self
    {
        $student = new self();

        $student->recordThat(StudentWasAdded::with(
            $studentId,
            $cardNumber,
            $person,
            $personalData
        ));

        return $student;
    }

    public function remove(): void
    {
        $this->recordThat(StudentWasRemoved::with(
            $this->studentId
        ));
    }

    /**
     * @return StudentId
     */
    public function studentId(): StudentId
    {
        return $this->studentId;
    }

    /**
     * @return StudentCardNumber
     */
    public function cardNumber(): StudentCardNumber
    {
        return $this->cardNumber;
    }

    /**
     * @return Person
     */
    public function person(): Person
    {
        return $this->person;
    }

    /**
     * @return PersonalData
     */
    public function personalData(): PersonalData
    {
        return $this->personalData;
    }

    protected function aggregateId(): string
    {
        return $this->studentId->toString();
    }

    public function __toString(): string
    {
        return sprintf(
            '%s %s [%s]',
            $this->person()->firstName()->toString(),
            $this->person()->lastName()->toString(),
            $this->cardNumber->toString()
        );
    }

    protected function applyStudentWasAdded(StudentWasAdded $event): void
    {
        $this->studentId = $event->studentId();
        $this->cardNumber = $event->cardNumber();
        $this->person = $event->person();
        $this->personalData = $event->personalData();
    }
}
