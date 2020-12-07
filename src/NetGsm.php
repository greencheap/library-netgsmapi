<?php
namespace GreenCheap;

/**
 * Class NetGSM
 * @package GreenCheap\NetGsm
 */
class NetGsm
{
    /**
     * Hangi Dengesiz Böyle Bir Format Kullanır?
     */
    const DATETIME = 'dmYHi';

    /**
     * @var string
     */
    public string $id;

    /**
     * @var string
     */
    public string $password;

    /**
     * @var string
     */
    public string $name;

    /**
     * NetGSM constructor.
     * @param string $id
     * @param string $password
     * @param string $name
     */
    public function __construct(string $id, string $password, string $name = '')
    {
        $this->id = $id;
        $this->password = $password;
        $this->name = $name;
    }

    /**
     * @return object
     */
    public function getInitialize(): object
    {
        return (object) [
            'usercode' => $this->id,
            'password' => $this->password,
            'type' => '1:n',
            'company' => [
                'value' => 'Netgsm',
                'attributes' => [
                    'dil' => 'TR'
                ]
            ],
            'msgheader' => $this->name ?: $this->id
        ];
    }
}
