<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 24.07.2018
 * Time: 17:33
 */

/**
 * Класс для поиска записей в базе данных
 */
class Search
{
    private $fields = [];   //Название столбцов таблицы, по которым происходит поиск
    private $model;         //Экземпляр искомого объекта
    private $searchString;  //Строка, по которой ведется поиск
    private $minWordsLength = 4;    //Минимальная длина слов, по которым ведется поиск


    public function __construct(){}


    public function setModel( &$object )
    {
        $this->model = $object;
        return $this;
    }


    public function searchingFor( $str )
    {
        $this->searchString = strval( $str );
        return $this;
    }


    public function setMinWordsLength( $length )
    {
        $this->minWordsLength = intval( $length );
        return $this;
    }


    public function appendSearchingRow( $row )
    {
        $this->fields[] = strval( $row );
        return $this;
    }


    private function getWords()
    {
        $output = [];
        $words = explode( " ", $this->searchString );

        foreach ( $words as $word )
        {
            $word = trim( $word );
            if( $word != "" && strlen( $word ) >= $this->minWordsLength )
                $output[] = $word;
        }

        return $output;
    }


    public function updateQuery()
    {
        $words = $this->getWords();

        foreach ( $words as $word )
        {
            $this->model->queryBuilder()
                ->open()
                    ->where( "subject", "LIKE", "%$word%" )
                    ->where( "description", "LIKE", "%$word%", "OR" )
                ->close();
        }
    }











}