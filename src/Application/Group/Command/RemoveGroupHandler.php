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

namespace App\Application\Group\Command;

use App\Domain\Group\Repository\Groups;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\CommandHandlerInterface;

final class RemoveGroupHandler implements CommandHandlerInterface
{
    /**
     * @var Groups
     */
    private $groups;

    public function __construct(Groups $groups)
    {
        $this->groups = $groups;
    }

    public function __invoke(RemoveGroup $command)
    {
        $group = $this->groups->get($command->groupId());

        $group->remove();

        $this->groups->save($group);
    }
}
