<?php
namespace  App\Repositories;

use App\Repositories\Repository;
use App\Models\Book;


class BookRepository extends Repository{

    function model()
    {
        return Book::class;
    }

}