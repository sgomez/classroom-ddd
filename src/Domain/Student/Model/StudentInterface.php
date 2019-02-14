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

interface StudentInterface
{
    /**
     * @return StudentId
     */
    public function studentId(): StudentId;

    /**
     * @return StudentCardNumber
     */
    public function cardNumber(): StudentCardNumber;

    /**
     * @return Person
     */
    public function person(): Person;

    /**
     * @return PersonalData
     */
    public function personalData(): PersonalData;
}
