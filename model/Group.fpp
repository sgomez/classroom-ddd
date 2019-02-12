namespace App\Domain\Group\Model {
    data GroupId = GroupId deriving (Uuid);
    data GroupName = String deriving (FromString, ToString, Equals) where
        | empty($value) => "Group name can not be empty.";
}

namespace App\Domain\Group\Event {
    data GroupWasAdded = GroupWasAdded {
        \App\Domain\Group\Model\GroupId $groupId,
        \App\Domain\Group\Model\GroupName $groupName,
    } deriving (AggregateChanged);

    data GroupWasRemoved = GroupWasRemoved {
        \App\Domain\Group\Model\GroupId $groupId,
    } deriving (AggregateChanged);

    data GroupMemberWasAdded = GroupMemberWasAdded {
        \App\Domain\Group\Model\GroupId $groupId,
        \App\Domain\Student\Model\StudentId $studentId
    } deriving (AggregateChanged);

    data GroupMemberWasRemoved = GroupMemberWasRemoved {
        \App\Domain\Group\Model\GroupId $groupId,
        \App\Domain\Student\Model\StudentId $studentId
    } deriving (AggregateChanged);

    data GroupLeaderWasAssigned = GroupLeaderWasAssigned {
        \App\Domain\Group\Model\GroupId $groupId,
        \App\Domain\Student\Model\StudentId $studentId
    } deriving (AggregateChanged);

    data GroupLeaderWasDismissed = GroupLeaderWasDismissed {
        \App\Domain\Group\Model\GroupId $groupId
    } deriving (AggregateChanged);
}

namespace App\Domain\Group\Exception {
    data UserDoesNotBelongToGroupException = UserDoesNotBelongToGroupException deriving(Exception) with
        | with UserId { string $userId } => 'UserId `{{ $userId }}` does not belong to group.'
}

namespace App\Application\Group\Exception {
    data GroupIdAlreadyRegisteredException = GroupIdAlreadyRegisteredException deriving(Exception) with
        | withGroupId { string $groupId } => 'GroupId `{{ $groupId }}` already taken.';
    data GroupNameAlreadyRegisteredException = GroupNameAlreadyRegisteredException deriving(Exception) with
        | withName { string $name } => 'Group name `{{ $name }}` already taken.';
}

namespace App\Application\Group\Command {
    data AddGroup = AddGroup {
        \App\Domain\Group\Model\GroupId $groupId,
        \App\Domain\Group\Model\GroupName $groupName,
    } deriving (AggregateChanged);

    data RemoveGroup = RemoveGroup {
        \App\Domain\Group\Model\GroupId $groupId,
    } deriving (AggregateChanged);

    data AddGroupMember = AddGroupMember {
        \App\Domain\Group\Model\GroupId $groupId,
        \App\Domain\Student\Model\StudentId $studentId
    } deriving (AggregateChanged);

    data RemoveGroupMember = RemoveGroupMember {
        \App\Domain\Group\Model\GroupId $groupId,
        \App\Domain\Student\Model\StudentId $studentId
    } deriving (AggregateChanged);

    data AssignGroupLeader = AssignGroupLeader {
        \App\Domain\Group\Model\GroupId $groupId,
        \App\Domain\Student\Model\StudentId $studentId
    } deriving (AggregateChanged);

    data DismissGroupLeader = DismissGroupLeader {
        \App\Domain\Group\Model\GroupId $groupId
    } deriving (AggregateChanged);
}

