<?php
/**
 * Created by PhpStorm.
 * User: Grego
 * Date: 27.11.2016
 * Time: 00:11
 */

namespace Greg0\LibraryBundle\Formatter;


use Greg0\LibraryBundle\Entity\Author;

class AuthorNameFormatter
{
    public static function getFullName(Author $author)
    {
        return sprintf('%s %s', $author->getFirstName(), $author->getLastName());
    }
}