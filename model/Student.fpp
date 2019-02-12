namespace App\Domain\Student\Model {
    data StudentId = StudentId deriving (Uuid);
    data StudentCardNumber = String deriving (FromString, ToString, Equals) where
        | empty($value) => "Student card number can not be empty.";
}

namespace App\Domain\Student\Event {
    data StudentWasAdded = StudentWasAdded {
        \App\Domain\Student\Model\StudentId $studentId,
        \App\Domain\Student\Model\StudentCardNumber $cardNumber,
        \App\Domain\Common\Model\Person $person,
        \App\Domain\Common\Model\PersonalData $personalData
    } deriving (AggregateChanged);

    data StudentWasRemoved = StudentWasRemoved {
        \App\Domain\Student\Model\StudentId $studentId
    } deriving (AggregateChanged);
}

namespace App\Application\Student\Exception {
    data StudentIdAlreadyRegisteredException = StudentIdAlreadyRegisteredException deriving(Exception) with
        | withStudentId { string $studentId } => 'StudentId `{{ $studentId }}` already taken.';
    data StudentCardNumberAlreadyRegisteredException = StudentCardNumberAlreadyRegisteredException deriving(Exception) with
        | withStudentCardNumber { string $studentCardNumber } => 'StudentCardNumber `{{ $studentCardNumber }}` already taken.';
}

namespace App\Application\Student\Command {
    data AddStudent = AddStudent {
        \App\Domain\Student\Model\StudentId $studentId,
        \App\Domain\Student\Model\StudentCardNumber $cardNumber,
        \App\Domain\Common\Model\Person $person,
        \App\Domain\Common\Model\PersonalData $personalData
    } deriving (Command);

    data RemoveStudent = RemoveStudent {
        \App\Domain\Student\Model\StudentId $studentId,
    } deriving (Command);
}
