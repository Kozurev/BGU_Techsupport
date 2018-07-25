<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 04.05.2018
 * Time: 12:06
 */

function debug($arg, $type = 0)
{
    echo "<pre>";
    if($type == 0)  print_r($arg);
    elseif($type == 1)  var_dump($arg);
    echo "</pre>";
}


/**
 * Возвращает ФИО или объект пользователя "исполнителя"
 * из списка по id
 * Используется в разделе статистика для более лаконичного формирования таблицы
 * и избежания избыточного кол-ва SQL-запросов
 *
 * @param $id   - id пользователя
 * @param $list - список исполнителей
 * @param $type - тип возвращаемого значения:
 *          "data" - возвращает ФИО (string)
 *          "obj"  - возвращает объект stdClass пользователя
 * @return string|stdClass
 */
function getPerformer( $id, $list, $type )
{
    foreach ( $list as $key => $performer )
        if( $performer->id == $id )
            if( $type == "data" ) return $performer->lastname . " " . $performer->firstname;
            elseif( $type == "obj" )    return $list[$key];

    if( $type == "data" )   return "Не определен";
}


/**
 * Возвращает объект из списка приоритетов с определенным id
 * функция аналогична getPerformer
 *
 * @param $id   - id приоритета
 * @param $list - список приоритетов
 * @return mixed
 */
function getPriority( $id, $list )
{
    foreach ( $list as $key => $priority )
    {
        if( $priority->getId() == $id ) return $list[$key];
    }
}


/**
 * Возвращает объект "системы" из списка с определенным id
 *
 * @param $id   - id системы
 * @param $list - саписок систем
 * @return mixed
 */
function getSystem( $id, $list )
{
    foreach ( $list as $key => $system )
    {
        if( $system->getId() == $id )   return $list[$key];
    }
}


/**
 * Возвращает кол-во общее количество послупивших заявок,
 * принадлежащих определенному исполнителю
 *
 * @param $id   - id исполнителя
 * @param $list - список заявок
 * @return int
 */
function countAdresserApps( $id, $list )
{
    $count = 0;
    foreach ( $list as $key => $app )
    {
        if( $app->performerId() == $id )
        {
            $count++;
        }
    }

    return $count;
}


/**
 * Возвращает кол-во выполненных заявок,
 * принадлежащих определенному исполнителю
 *
 * @param $id   - id исполнителя
 * @param $list - список заявок
 * @return int
 */
function countDoneApps( $id, $list )
{
    $count = 0;
    foreach ( $list as $key => $app )
    {
        if( $app->doneEnd() != null && $app->performerId() == $id )
        {
            $count++;
        }
    }

    return $count;
}


/**
 * Возвращает кол-во выполненных заявок в срок, соответствующий приоритету
 *
 * @param $performerId  - id исполнителя
 * @param $Applications - список заявок
 * @param $Priorities   - список приоритетов
 * @return int
 */
function countDoneAppsInTime( $performerId, $Applications, $Priorities )
{
    $count = 0;

    foreach ( $Applications as $app )
        if( $app->performerId() == $performerId && $app->doneEnd() != null )
        {
            $priorityTime = getPriority( $app->priorityId(), $Priorities )->hours();
            if( $priorityTime >= ( $app->doneEnd() - $app->createDate() ) )  $count++;
        }

    return $count;
}