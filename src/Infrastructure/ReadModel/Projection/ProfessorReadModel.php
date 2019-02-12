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

namespace App\Infrastructure\ReadModel\Projection;

use App\Domain\Professor\Event\ProfessorWasAdded;
use App\Infrastructure\Entity\ProfessorView;
use App\Infrastructure\ReadModel\Repository\ProfessorViews;
use AulaSoftwareLibre\DDD\BaseBundle\Domain\ApplyMethodDispatcherTrait;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\EventHandlerInterface;
use AulaSoftwareLibre\DDD\BaseBundle\Prooph\EventStore\Projection\AbstractDoctrineReadModel;
use Doctrine\Common\Persistence\ManagerRegistry;

class ProfessorReadModel extends AbstractDoctrineReadModel implements EventHandlerInterface
{
    use ApplyMethodDispatcherTrait {
        applyMessage as public __invoke;
    }

    /**
     * @var ProfessorViews
     */
    private $professorViews;

    public function __construct(ManagerRegistry $registry, ProfessorViews $professorViews)
    {
        parent::__construct($registry, ProfessorView::class);

        $this->professorViews = $professorViews;
    }

    public function applyProfessorWasAdded(ProfessorWasAdded $event): void
    {
        $professorView = new ProfessorView();
    }
}
