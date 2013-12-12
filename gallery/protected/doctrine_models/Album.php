<?php
/**
 * @Entity @Table(name="albums")
 **/
class Album
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $name;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $url;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $likes;
}