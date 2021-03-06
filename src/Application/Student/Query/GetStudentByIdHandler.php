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

namespace App\Application\Student\Query;

use App\Infrastructure\Entity\StudentView;
use App\Infrastructure\ReadModel\Repository\StudentViews;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\QueryHandlerInterface;

final class GetStudentByIdHandler implements QueryHandlerInterface
{
    /**
     * @var StudentViews
     */
    private $studentViews;

    public function __construct(StudentViews $studentViews)
    {
        $this->studentViews = $studentViews;
    }

    public function __invoke(GetStudentById $query): ?StudentView
    {
        $id = $query->studentId()->toString();

        return $this->studentViews->get($id);
    }
}
