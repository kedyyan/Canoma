<?php
/**
 * @author Mark van der Velden <mark@dynom.nl>
 */
class Adler32Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Canoma\Factory
     */
    private $factory;
    private $adapterConfig = array();


    public function setUp()
    {
        // Use the factory and define the required config.
        $this->factory = new \Canoma\Factory();
        $this->adapterConfig[\Canoma\Factory::CONF_HASHING_ADAPTER] = 'Adler32';
    }

    /**
     * @dataProvider simpleStringProvider
     */
    public function testSimpleHashing($someString)
    {
        $adapter = $this->factory->createAdapter($this->adapterConfig);

        $this->assertTrue(ctype_alnum($adapter->hash($someString)));
        $this->assertEquals(hash('adler32', $someString), $adapter->hash($someString));
    }

    /**
     * Provider of strings.
     *
     * @return array
     */
    public function simpleStringProvider()
    {
        return array(
            array('A simple string, that should definitely not pass a ctype_alnum test!'),
        );
    }
}