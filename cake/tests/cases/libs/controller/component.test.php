<?php
/**
 * ComponentTest file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) Tests <http://book.cakephp.org/view/1196/Testing>
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://book.cakephp.org/view/1196/Testing CakePHP(tm) Tests
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 * @since         CakePHP(tm) v 1.2.0.5436
 * @license       http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
App::import('Controller', 'Controller', false);
App::import('Controller', 'Component', false);

if (!class_exists('AppController')) {

/**
 * AppController class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
	class AppController extends Controller {

/**
 * name property
 *
 * @var string 'App'
 * @access public
 */
		public $name = 'App';

/**
 * uses property
 *
 * @var array
 * @access public
 */
		public $uses = array();

/**
 * helpers property
 *
 * @var array
 * @access public
 */
		public $helpers = array();

/**
 * components property
 *
 * @var array
 * @access public
 */
		public $components = array('Orange' => array('colour' => 'blood orange'));
	}
} elseif (!defined('APP_CONTROLLER_EXISTS')){
	define('APP_CONTROLLER_EXISTS', true);
}

/**
 * ParamTestComponent
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class ParamTestComponent extends Component {

/**
 * name property
 *
 * @var string 'ParamTest'
 * @access public
 */
	public $name = 'ParamTest';

/**
 * components property
 *
 * @var array
 * @access public
 */
	public $components = array('Banana' => array('config' => 'value'));

/**
 * initialize method
 *
 * @param mixed $controller
 * @param mixed $settings
 * @access public
 * @return void
 */
	function initialize(&$controller, $settings) {
		foreach ($settings as $key => $value) {
			if (is_numeric($key)) {
				$this->{$value} = true;
			} else {
				$this->{$key} = $value;
			}
		}
	}
}

/**
 * ComponentTestController class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class ComponentTestController extends AppController {

/**
 * name property
 *
 * @var string 'ComponentTest'
 * @access public
 */
	public $name = 'ComponentTest';

/**
 * uses property
 *
 * @var array
 * @access public
 */
	public $uses = array();
}

/**
 * AppleComponent class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class AppleComponent extends Component {

/**
 * components property
 *
 * @var array
 * @access public
 */
	public $components = array('Orange');

/**
 * testName property
 *
 * @var mixed null
 * @access public
 */
	public $testName = null;

/**
 * startup method
 *
 * @param mixed $controller
 * @access public
 * @return void
 */
	function startup(&$controller) {
		$this->testName = $controller->name;
	}
}

/**
 * OrangeComponent class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class OrangeComponent extends Component {

/**
 * components property
 *
 * @var array
 * @access public
 */
	public $components = array('Banana');

/**
 * initialize method
 *
 * @param mixed $controller
 * @access public
 * @return void
 */
	function initialize(&$controller, $settings) {
		$this->Controller = $controller;
		$this->Banana->testField = 'OrangeField';
		$this->settings = $settings;
	}

/**
 * startup method
 *
 * @param Controller $controller
 * @return string
 */
	public function startup(&$controller) {
		$controller->foo = 'pass';
	}
}

/**
 * BananaComponent class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class BananaComponent extends Component {

/**
 * testField property
 *
 * @var string 'BananaField'
 * @access public
 */
	public $testField = 'BananaField';

/**
 * startup method
 *
 * @param Controller $controller
 * @return string
 */
	public function startup(&$controller) {
		$controller->bar = 'fail';
	}
}

/**
 * MutuallyReferencingOneComponent class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class MutuallyReferencingOneComponent extends Component {

/**
 * components property
 *
 * @var array
 * @access public
 */
	public $components = array('MutuallyReferencingTwo');
}

/**
 * MutuallyReferencingTwoComponent class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class MutuallyReferencingTwoComponent extends Component {

/**
 * components property
 *
 * @var array
 * @access public
 */
	public $components = array('MutuallyReferencingOne');
}

/**
 * SomethingWithEmailComponent class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class SomethingWithEmailComponent extends Component {

/**
 * components property
 *
 * @var array
 * @access public
 */
	public $components = array('Email');
}


/**
 * ComponentTest class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class ComponentTest extends CakeTestCase {

/**
 * setUp method
 *
 * @access public
 * @return void
 */
	function setUp() {
		$this->_pluginPaths = App::path('plugins');
		App::build(array(
			'plugins' => array(TEST_CAKE_CORE_INCLUDE_PATH . 'tests' . DS . 'test_app' . DS . 'plugins' . DS)
		));
	}

/**
 * tearDown method
 *
 * @access public
 * @return void
 */
	function tearDown() {
		App::build();
		ClassRegistry::flush();
	}

/**
 * test accessing inner components.
 *
 * @return void
 */
	function testInnerComponentConstruction() {
		$Collection = new ComponentCollection();
		$Component = new AppleComponent($Collection);

		$this->assertType('OrangeComponent', $Component->Orange, 'class is wrong');
	}

/**
 * testLoadComponents method
 *
 * @access public
 * @return void
 */
	function testLoadComponents() {
		$this->markTestSkipped('init() will be removed from Component');

		$Controller =& new ComponentTestController();
		$Controller->components = array('RequestHandler');

		$Component =& new Component();
		$Component->init($Controller);

		$this->assertTrue(is_a($Controller->RequestHandler, 'RequestHandlerComponent'));

		$Controller =& new ComponentTestController();
		$Controller->plugin = 'test_plugin';
		$Controller->components = array('RequestHandler', 'TestPluginComponent');

		$Component =& new Component();
		$Component->init($Controller);

		$this->assertTrue(is_a($Controller->RequestHandler, 'RequestHandlerComponent'));
		$this->assertTrue(is_a($Controller->TestPluginComponent, 'TestPluginComponentComponent'));
		$this->assertTrue(is_a(
			$Controller->TestPluginComponent->TestPluginOtherComponent,
			'TestPluginOtherComponentComponent'
		));
		$this->assertFalse(isset($Controller->TestPluginOtherComponent));

		$Controller =& new ComponentTestController();
		$Controller->components = array('Security');

		$Component =& new Component();
		$Component->init($Controller);

		$this->assertTrue(is_a($Controller->Security, 'SecurityComponent'));
		$this->assertTrue(is_a($Controller->Security->Session, 'SessionComponent'));

		$Controller =& new ComponentTestController();
		$Controller->components = array('Security', 'Cookie', 'RequestHandler');

		$Component =& new Component();
		$Component->init($Controller);

		$this->assertTrue(is_a($Controller->Security, 'SecurityComponent'));
		$this->assertTrue(is_a($Controller->Security->RequestHandler, 'RequestHandlerComponent'));
		$this->assertTrue(is_a($Controller->RequestHandler, 'RequestHandlerComponent'));
		$this->assertTrue(is_a($Controller->Cookie, 'CookieComponent'));
	}

/**
 * test component loading
 *
 * @return void
 */
	function testNestedComponentLoading() {
		$Collection = new ComponentCollection();
		$Apple = new AppleComponent($Collection);

		$this->assertType('OrangeComponent', $Apple->Orange, 'class is wrong');
		$this->assertType('BananaComponent', $Apple->Orange->Banana, 'class is wrong');
		$this->assertTrue(empty($Apple->Session));
		$this->assertTrue(empty($Apple->Orange->Session));
	}

/**
 * test that component components are not enabled in the collection.
 *
 * @return void
 */
	function testInnerComponentsAreNotEnabled() {
		$Collection = new ComponentCollection();
		$Apple = $Collection->load('Apple');

		$this->assertType('OrangeComponent', $Apple->Orange, 'class is wrong');
		$result = $Collection->enabled();
		$this->assertEquals(array('Apple'), $result, 'Too many components enabled.');
	}

/**
 * test a component being used more than once.
 *
 * @return void
 */
	function testMultipleComponentInitialize() {
		$Collection = new ComponentCollection();
		$Banana = $Collection->load('Banana');
		$Orange = $Collection->load('Orange');
		
		$this->assertSame($Banana, $Orange->Banana, 'Should be references');
		$Banana->testField = 'OrangeField';
		
		$this->assertSame($Banana->testField, $Orange->Banana->testField, 'References are broken');
	}

/**
 * Test Component declarations with Parameters
 * tests merging of component parameters and merging / construction of components.
 *
 * @return void
 */
	function testComponentsWithParams() {
		if ($this->skipIf(defined('APP_CONTROLLER_EXISTS'), '%s Need a non-existent AppController')) {
			return;
		}
		$this->markTestSkipped('MergeVars test covers this.');

		$Controller =& new ComponentTestController();
		$Controller->components = array('ParamTest' => array('test' => 'value', 'flag'), 'Apple');
		$Controller->uses = false;
		$Controller->constructClasses();
		$Controller->Component->initialize($Controller);

		$this->assertTrue(is_a($Controller->ParamTest, 'ParamTestComponent'));
		$this->assertTrue(is_a($Controller->ParamTest->Banana, 'BananaComponent'));
		$this->assertTrue(is_a($Controller->Orange, 'OrangeComponent'));
		$this->assertFalse(isset($Controller->Session));
		$this->assertEqual($Controller->Orange->settings, array('colour' => 'blood orange'));
		$this->assertEqual($Controller->ParamTest->test, 'value');
		$this->assertEqual($Controller->ParamTest->flag, true);

		//Settings are merged from app controller and current controller.
		$Controller =& new ComponentTestController();
		$Controller->components = array(
			'ParamTest' => array('test' => 'value'),
			'Orange' => array('ripeness' => 'perfect')
		);
		$Controller->constructClasses();
		$Controller->Component->initialize($Controller);

		$expected = array('colour' => 'blood orange', 'ripeness' => 'perfect');
		$this->assertEqual($Controller->Orange->settings, $expected);
		$this->assertEqual($Controller->ParamTest->test, 'value');
	}

/**
 * Ensure that settings are not duplicated when passed into component initialize.
 *
 * @return void
 */
	function testComponentParamsNoDuplication() {
		if ($this->skipIf(defined('APP_CONTROLLER_EXISTS'), '%s Need a non-existent AppController')) {
			return;
		}
		$this->markTestSkipped('MergeVars test covers this.');

		$Controller =& new ComponentTestController();
		$Controller->components = array('Orange' => array('setting' => array('itemx')));
		$Controller->uses = false;

		$Controller->constructClasses();
		$Controller->Component->initialize($Controller);
		$expected = array('setting' => array('itemx'), 'colour' => 'blood orange');
		$this->assertEqual($Controller->Orange->settings, $expected, 'Params duplication has occured %s');
	}

/**
 * Test mutually referencing components.
 *
 * @return void
 */
	function testMutuallyReferencingComponents() {
		$this->markTestSkipped('ComponentCollection handles this');

		$Controller =& new ComponentTestController();
		$Controller->components = array('MutuallyReferencingOne');
		$Controller->uses = false;
		$Controller->constructClasses();
		$Controller->Component->initialize($Controller);

		$this->assertTrue(is_a(
			$Controller->MutuallyReferencingOne,
			'MutuallyReferencingOneComponent'
		));
		$this->assertTrue(is_a(
			$Controller->MutuallyReferencingOne->MutuallyReferencingTwo,
			'MutuallyReferencingTwoComponent'
		));
		$this->assertTrue(is_a(
			$Controller->MutuallyReferencingOne->MutuallyReferencingTwo->MutuallyReferencingOne,
			'MutuallyReferencingOneComponent'
		));
	}

/**
 * Test mutually referencing components.
 *
 * @return void
 */
	function testSomethingReferencingEmailComponent() {
		$this->markTestIncomplete('Will need to be updated');

		$Controller =& new ComponentTestController();
		$Controller->components = array('SomethingWithEmail');
		$Controller->uses = false;
		$Controller->constructClasses();
		$Controller->Component->initialize($Controller);
		$Controller->beforeFilter();
		$Controller->Component->startup($Controller);

		$this->assertTrue(is_a(
			$Controller->SomethingWithEmail,
			'SomethingWithEmailComponent'
		));
		$this->assertTrue(is_a(
			$Controller->SomethingWithEmail->Email,
			'EmailComponent'
		));
		$this->assertTrue(is_a(
			$Controller->SomethingWithEmail->Email->Controller,
			'ComponentTestController'
		));
	}

/**
 * test that components can modify values from beforeRedirect
 *
 * @return void
 */
	function testBeforeRedirectModification() {
		$this->markTestIncomplete('This test needs to be implemented');
		/*
		*$MockController = new MockController();
		$MockController->components = array('MockTest');
		$MockController->Component = new Component();
		$MockController->Component->init($MockController);
		$MockController->MockTest->setReturnValue('beforeRedirect', 'http://book.cakephp.org');
		$MockController->expectAt(0, 'header', array('HTTP/1.1 301 Moved Permanently'));
		$MockController->expectAt(1, 'header', array('Location: http://book.cakephp.org'));
		$MockController->expectCallCount('header', 2);
		$MockController->redirect('http://cakephp.org', 301, false);

		$MockController = new MockController();
		$MockController->components = array('MockTest');
		$MockController->Component = new Component();
		$MockController->Component->init($MockController);
		$MockController->MockTest->setReturnValue('beforeRedirect', false);
		$MockController->expectNever('header');
		$MockController->redirect('http://cakephp.org', 301, false);

		$MockController = new MockController();
		$MockController->components = array('MockTest', 'MockTestB');
		$MockController->Component = new Component();
		$MockController->Component->init($MockController);
		$MockController->MockTest->setReturnValue('beforeRedirect', 'http://book.cakephp.org');
		$MockController->MockTestB->setReturnValue('beforeRedirect', 'http://bakery.cakephp.org');
		$MockController->expectAt(0, 'header', array('HTTP/1.1 301 Moved Permanently'));
		$MockController->expectAt(1, 'header', array('Location: http://bakery.cakephp.org'));
		$MockController->expectCallCount('header', 2);
		$MockController->redirect('http://cakephp.org', 301, false);
		*/
	}

/**
 * test that components can pass modifying values from beforeRedirect
 *
 * @return void
 */
	function testBeforeRedirectPass() {
		$this->markTestIncomplete('This test needs to be implemented');
	}

/**
 * Test that SessionComponent doesn't get added if its already in the components array.
 *
 * @return void
 */
	public function testDoubleLoadingOfSessionComponent() {
		if ($this->skipIf(defined('APP_CONTROLLER_EXISTS'), '%s Need a non-existent AppController')) {
			return;
		}

		$Controller =& new ComponentTestController();
		$Controller->uses = false;
		$Controller->components = array('Session');
		$Controller->constructClasses();

		$this->assertEqual($Controller->components, array('Session' => '', 'Orange' => array('colour' => 'blood orange')));
	}

}
