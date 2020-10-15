<?php
namespace GreenCheap;

/**
 * Class NetGSM
 * @package GreenCheap\NetGsm
 */
class NetGsm
{
    /**
     * @var string
     */
    protected string $id;

    /**
     * @var string
     */
    protected string $password;

    /**
     * @var string
     */
    protected string $name;

    /**
     * NetGSM constructor.
     * @param string $id
     * @param string $password
     * @param string $name
     */
    public function __construct(string $id, string $password, string $name = null)
    {
        $this->id = $id;
        $this->password = $password;
        $this->name = $name;
    }

    /**
     * @return object
     */
    public function initialize(): object
    {
        return (object) [
            'id' => $this->id,
            'password' => $this->password,
            'name' => $this->name
        ];
    }

    /**
     * @param string $date
     */
    public static function sendNow($date = 'now')
    {

    }
}
