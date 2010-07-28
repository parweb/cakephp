<?php
/**
 * ControllerTest file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP Project
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 * @since         CakePHP(tm) v 1.2.0.5436
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::import('Controller', 'Controller', false);
App::import('Component', 'Security');
App::import('Component', 'Cookie');

/**
 * AppController class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
if (!class_exists('AppController')) {
	/**
	 * AppController class
	 *
	 * @package       cake
	 * @subpackage    cake.tests.cases.libs.controller
	 */
	class AppController extends Controller {
	/**
	 * helpers property
	 *
	 * @var array
	 * @access public
	 */
		public $helpers = array('Html');
	/**
	 * uses property
	 *
	 * @var array
	 * @access public
	 */
		public $uses = array('ControllerPost');
	/**
	 * components property
	 *
	 * @var array
	 * @access public
	 */
		public $components = array('Cookie');
	}
} elseif (!defined('APP_CONTROLLER_EXISTS')) {
	define('APP_CONTROLLER_EXISTS', true);
}

/**
 * ControllerPost class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class ControllerPost extends CakeTestModel {

/**
 * name property
 *
 * @var string 'ControllerPost'
 * @access public
 */
	public $name = 'ControllerPost';

/**
 * useTable property
 *
 * @var string 'posts'
 * @access public
 */
	public $useTable = 'posts';

/**
 * invalidFields property
 *
 * @var array
 * @access public
 */
	public $invalidFields = array('name' => 'error_msg');

/**
 * lastQuery property
 *
 * @var mixed null
 * @access public
 */
	public $lastQuery = null;

/**
 * beforeFind method
 *
 * @param mixed $query
 * @access public
 * @return void
 */
	function beforeFind($query) {
		$this->lastQuery = $query;
	}

/**
 * find method
 *
 * @param mixed $type
 * @param array $options
 * @access public
 * @return void
 */
	function find($type, $options = array()) {
		if ($type == 'popular') {
			$conditions = array($this->name . '.' . $this->primaryKey .' > ' => '1');
			$options = Set::merge($options, compact('conditions'));
			return parent::find('all', $options);
		}
		return parent::find($type, $options);
	}
}

/**
 * ControllerPostsController class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class ControllerCommentsController extends AppController {

/**
 * name property
 *
 * @var string 'ControllerPost'
 * @access public
 */
	public $name = 'ControllerComments';
}

/**
 * ControllerComment class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class ControllerComment extends CakeTestModel {

/**
 * name property
 *
 * @var string 'ControllerComment'
 * @access public
 */
	public $name = 'Comment';

/**
 * useTable property
 *
 * @var string 'comments'
 * @access public
 */
	public $useTable = 'comments';

/**
 * data property
 *
 * @var array
 * @access public
 */
	public $data = array('name' => 'Some Name');

/**
 * alias property
 *
 * @var string 'ControllerComment'
 * @access public
 */
	public $alias = 'ControllerComment';
}

/**
 * ControllerAlias class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class ControllerAlias extends CakeTestModel {

/**
 * name property
 *
 * @var string 'ControllerAlias'
 * @access public
 */
	public $name = 'ControllerAlias';

/**
 * alias property
 *
 * @var string 'ControllerSomeAlias'
 * @access public
 */
	public $alias = 'ControllerSomeAlias';

/**
 * useTable property
 *
 * @var string 'posts'
 * @access public
 */
	public $useTable = 'posts';
}

/**
 * ControllerPaginateModel class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class ControllerPaginateModel extends CakeTestModel {

/**
 * name property
 *
 * @var string
 * @access public
 */
	public $name = 'ControllerPaginateModel';

/**
 * useTable property
 *
 * @var string'
 * @access public
 */
	public $useTable = 'comments';

/**
 * paginate method
 *
 * @return void
 */
	public function paginate($conditions, $fields, $order, $limit, $page, $recursive, $extra) {
		$this->extra = $extra;
	}

/**
 * paginateCount
 *
 * @access public
 * @return void
 */
	function paginateCount($conditions, $recursive, $extra) {
		$this->extraCount = $extra;
	}
}

/**
 * NameTest class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class NameTest extends CakeTestModel {

/**
 * name property
 * @var string 'Name'
 * @access public
 */
	public $name = 'Name';

/**
 * useTable property
 * @var string 'names'
 * @access public
 */
	public $useTable = 'comments';

/**
 * alias property
 *
 * @var string 'ControllerComment'
 * @access public
 */
	public $alias = 'Name';
}

/**
 * TestController class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class TestController extends AppController {

/**
 * name property
 * @var string 'Name'
 * @access public
 */
	public $name = 'TestController';

/**
 * helpers property
 *
 * @var array
 * @access public
 */
	public $helpers = array('Session', 'Xml');

/**
 * components property
 *
 * @var array
 * @access public
 */
	public $components = array('Security');

/**
 * uses property
 *
 * @var array
 * @access public
 */
	public $uses = array('ControllerComment', 'ControllerAlias');

/**
 * index method
 *
 * @param mixed $testId
 * @param mixed $test2Id
 * @access public
 * @return void
 */
	function index($testId, $test2Id) {
		$this->data['testId'] = $testId;
		$this->data['test2Id'] = $test2Id;
	}
}

/**
 * TestComponent class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class TestComponent extends Object {

/**
 * beforeRedirect method
 *
 * @access public
 * @return void
 */
	function beforeRedirect() {
	}
/**
 * initialize method
 *
 * @access public
 * @return void
 */
	function initialize(&$controller) {
	}

/**
 * startup method
 *
 * @access public
 * @return void
 */
	function startup(&$controller) {
	}
/**
 * shutdown method
 *
 * @access public
 * @return void
 */
	function shutdown(&$controller) {
	}
/**
 * beforeRender callback
 *
 * @return void
 */
	function beforeRender(&$controller) {
		if ($this->viewclass) {
			$controller->view = $this->viewclass;
		}
	}
}

/**
 * AnotherTestController class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class AnotherTestController extends AppController {

/**
 * name property
 * @var string 'Name'
 * @access public
 */
	public $name = 'AnotherTest';
/**
 * uses property
 *
 * @var array
 * @access public
 */
	public $uses = null;
}

/**
 * ControllerTest class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.controller
 */
class ControllerTest extends CakeTestCase {

/**
 * fixtures property
 *
 * @var array
 * @access public
 */
	public $fixtures = array('core.post', 'core.comment', 'core.name');

/**
 * endTest
 *
 * @access public
 * @return void
 */
	function endTest() {
		App::build();
	}

/**
 * testLoadModel method
 *
 * @access public
 * @return void
 */
	function testLoadModel() {
		$Controller = new Controller();

		$this->assertFalse(isset($Controller->ControllerPost));

		$result = $Controller->loadModel('ControllerPost');
		$this->assertTrue($result);
		$this->assertTrue(is_a($Controller->ControllerPost, 'ControllerPost'));
		$this->assertTrue(in_array('ControllerPost', $Controller->modelNames));

		ClassRegistry::flush();
		unset($Controller);
	}

/**
 * testLoadModel method from a plugin controller
 *
 * @access public
 * @return void
 */
	function testLoadModelInPlugins() {
		App::build(array(
			'plugins' => array(TEST_CAKE_CORE_INCLUDE_PATH . 'tests' . DS . 'test_app' . DS . 'plugins' . DS),
			'controllers' => array(TEST_CAKE_CORE_INCLUDE_PATH . 'tests' . DS . 'test_app' . DS . 'controllers' . DS),
			'models' => array(TEST_CAKE_CORE_INCLUDE_PATH . 'tests' . DS . 'test_app' . DS . 'models' . DS)
		));
		App::import('Controller', 'TestPlugin.TestPlugin');

		$Controller = new TestPluginController();
		$Controller->plugin = 'TestPlugin';
		$Controller->uses = false;

		$this->assertFalse(isset($Controller->Comment));

		$result = $Controller->loadModel('Comment');
		$this->assertTrue($result);
		$this->assertType('Comment', $Controller->Comment);
		$this->assertTrue(in_array('Comment', $Controller->modelNames));

		ClassRegistry::flush();
		unset($Controller);
	}

/**
 * testConstructClasses method
 *
 * @access public
 * @return void
 */
	function testConstructClasses() {
		$Controller = new Controller();
		$Controller->modelClass = 'ControllerPost';
		$Controller->passedArgs[] = '1';
		$Controller->constructClasses();
		$this->assertEqual($Controller->ControllerPost->id, 1);

		unset($Controller);

		$Controller = new Controller();
		$Controller->uses = array('ControllerPost', 'ControllerComment');
		$Controller->passedArgs[] = '1';
		$Controller->constructClasses();
		$this->assertTrue(is_a($Controller->ControllerPost, 'ControllerPost'));
		$this->assertTrue(is_a($Controller->ControllerComment, 'ControllerComment'));

		$this->assertEqual($Controller->ControllerComment->name, 'Comment');

		unset($Controller);

		App::build(array('plugins' => array(TEST_CAKE_CORE_INCLUDE_PATH . 'tests' . DS . 'test_app' . DS . 'plugins' . DS)));

		$Controller = new Controller();
		$Controller->uses = array('TestPlugin.TestPluginPost');
		$Controller->constructClasses();

		$this->assertEqual($Controller->modelClass, 'TestPluginPost');
		$this->assertTrue(isset($Controller->TestPluginPost));
		$this->assertTrue(is_a($Controller->TestPluginPost, 'TestPluginPost'));

		unset($Controller);
	}

/**
 * testAliasName method
 *
 * @access public
 * @return void
 */
	function testAliasName() {
		$Controller = new Controller();
		$Controller->uses = array('NameTest');
		$Controller->constructClasses();

		$this->assertEqual($Controller->NameTest->name, 'Name');
		$this->assertEqual($Controller->NameTest->alias, 'Name');

		unset($Controller);
	}

/**
 * testPersistent method
 *
 * @access public
 * @return void
 */
	function testPersistent() {
		$this->markTestIncomplete('persistModel is totally broken right now.');

		Configure::write('Cache.disable', false);
		$Controller = new Controller();
		$Controller->modelClass = 'ControllerPost';
		$Controller->persistModel = true;
		$Controller->constructClasses();
		$this->assertTrue(file_exists(CACHE . 'persistent' . DS .'controllerpost.php'));
		$this->assertTrue(is_a($Controller->ControllerPost, 'ControllerPost'));
		@unlink(CACHE . 'persistent' . DS . 'controllerpost.php');
		@unlink(CACHE . 'persistent' . DS . 'controllerpostregistry.php');

		unset($Controller);
		Configure::write('Cache.disable', true);
	}

/**
 * testPaginate method
 *
 * @access public
 * @return void
 */
	function testPaginate() {
		$Controller = new Controller();
		$Controller->uses = array('ControllerPost', 'ControllerComment');
		$Controller->passedArgs[] = '1';
		$Controller->params['url'] = array();
		$Controller->constructClasses();

		$results = Set::extract($Controller->paginate('ControllerPost'), '{n}.ControllerPost.id');
		$this->assertEqual($results, array(1, 2, 3));

		$results = Set::extract($Controller->paginate('ControllerComment'), '{n}.ControllerComment.id');
		$this->assertEqual($results, array(1, 2, 3, 4, 5, 6));

		$Controller->modelClass = null;

		$Controller->uses[0] = 'Plugin.ControllerPost';
		$results = Set::extract($Controller->paginate(), '{n}.ControllerPost.id');
		$this->assertEqual($results, array(1, 2, 3));

		$Controller->passedArgs = array('page' => '-1');
		$results = Set::extract($Controller->paginate('ControllerPost'), '{n}.ControllerPost.id');
		$this->assertEqual($Controller->params['paging']['ControllerPost']['page'], 1);
		$this->assertEqual($results, array(1, 2, 3));

		$Controller->passedArgs = array('sort' => 'ControllerPost.id', 'direction' => 'asc');
		$results = Set::extract($Controller->paginate('ControllerPost'), '{n}.ControllerPost.id');
		$this->assertEqual($Controller->params['paging']['ControllerPost']['page'], 1);
		$this->assertEqual($results, array(1, 2, 3));

		$Controller->passedArgs = array('sort' => 'ControllerPost.id', 'direction' => 'desc');
		$results = Set::extract($Controller->paginate('ControllerPost'), '{n}.ControllerPost.id');
		$this->assertEqual($Controller->params['paging']['ControllerPost']['page'], 1);
		$this->assertEqual($results, array(3, 2, 1));

		$Controller->passedArgs = array('sort' => 'id', 'direction' => 'desc');
		$results = Set::extract($Controller->paginate('ControllerPost'), '{n}.ControllerPost.id');
		$this->assertEqual($Controller->params['paging']['ControllerPost']['page'], 1);
		$this->assertEqual($results, array(3, 2, 1));

		$Controller->passedArgs = array('sort' => 'NotExisting.field', 'direction' => 'desc');
		$results = Set::extract($Controller->paginate('ControllerPost'), '{n}.ControllerPost.id');
		$this->assertEqual($Controller->params['paging']['ControllerPost']['page'], 1, 'Invalid field in query %s');
		$this->assertEqual($results, array(1, 2, 3));

		$Controller->passedArgs = array('sort' => 'ControllerPost.author_id', 'direction' => 'allYourBase');
		$results = Set::extract($Controller->paginate('ControllerPost'), '{n}.ControllerPost.id');
		$this->assertEqual($Controller->ControllerPost->lastQuery['order'][0], array('ControllerPost.author_id' => 'asc'));
		$this->assertEqual($results, array(1, 3, 2));

		$Controller->passedArgs = array('page' => '1 " onclick="alert(\'xss\');">');
		$Controller->paginate = array('limit' => 1);
		$Controller->paginate('ControllerPost');
		$this->assertIdentical($Controller->params['paging']['ControllerPost']['page'], 1, 'XSS exploit opened %s');
		$this->assertIdentical($Controller->params['paging']['ControllerPost']['options']['page'], 1, 'XSS exploit opened %s');

		$Controller->passedArgs = array();
		$Controller->paginate = array('limit' => 0);
		$Controller->paginate('ControllerPost');
		$this->assertIdentical($Controller->params['paging']['ControllerPost']['page'], 1);
		$this->assertIdentical($Controller->params['paging']['ControllerPost']['pageCount'], 3);
		$this->assertIdentical($Controller->params['paging']['ControllerPost']['prevPage'], false);
		$this->assertIdentical($Controller->params['paging']['ControllerPost']['nextPage'], true);

		$Controller->passedArgs = array();
		$Controller->paginate = array('limit' => 'garbage!');
		$Controller->paginate('ControllerPost');
		$this->assertIdentical($Controller->params['paging']['ControllerPost']['page'], 1);
		$this->assertIdentical($Controller->params['paging']['ControllerPost']['pageCount'], 3);
		$this->assertIdentical($Controller->params['paging']['ControllerPost']['prevPage'], false);
		$this->assertIdentical($Controller->params['paging']['ControllerPost']['nextPage'], true);

		$Controller->passedArgs = array();
		$Controller->paginate = array('limit' => '-1');
		$Controller->paginate('ControllerPost');
		$this->assertIdentical($Controller->params['paging']['ControllerPost']['page'], 1);
		$this->assertIdentical($Controller->params['paging']['ControllerPost']['pageCount'], 3);
		$this->assertIdentical($Controller->params['paging']['ControllerPost']['prevPage'], false);
		$this->assertIdentical($Controller->params['paging']['ControllerPost']['nextPage'], true);
	}

/**
 * testPaginateExtraParams method
 *
 * @access public
 * @return void
 */
	function testPaginateExtraParams() {
		$Controller = new Controller();
		$Controller->uses = array('ControllerPost', 'ControllerComment');
		$Controller->passedArgs[] = '1';
		$Controller->params['url'] = array();
		$Controller->constructClasses();

		$Controller->passedArgs = array('page' => '-1', 'contain' => array('ControllerComment'));
		$result = $Controller->paginate('ControllerPost');
		$this->assertEqual($Controller->params['paging']['ControllerPost']['page'], 1);
		$this->assertEqual(Set::extract($result, '{n}.ControllerPost.id'), array(1, 2, 3));
		$this->assertTrue(!isset($Controller->ControllerPost->lastQuery['contain']));

		$Controller->passedArgs = array('page' => '-1');
		$Controller->paginate = array('ControllerPost' => array('contain' => array('ControllerComment')));
		$result = $Controller->paginate('ControllerPost');
		$this->assertEqual($Controller->params['paging']['ControllerPost']['page'], 1);
		$this->assertEqual(Set::extract($result, '{n}.ControllerPost.id'), array(1, 2, 3));
		$this->assertTrue(isset($Controller->ControllerPost->lastQuery['contain']));

		$Controller->paginate = array('ControllerPost' => array('popular', 'fields' => array('id', 'title')));
		$result = $Controller->paginate('ControllerPost');
		$this->assertEqual(Set::extract($result, '{n}.ControllerPost.id'), array(2, 3));
		$this->assertEqual($Controller->ControllerPost->lastQuery['conditions'], array('ControllerPost.id > ' => '1'));

		$Controller->passedArgs = array('limit' => 12);
		$Controller->paginate = array('limit' => 30);
		$result = $Controller->paginate('ControllerPost');
		$paging = $Controller->params['paging']['ControllerPost'];

		$this->assertEqual($Controller->ControllerPost->lastQuery['limit'], 12);
		$this->assertEqual($paging['options']['limit'], 12);

		$Controller = new Controller();
		$Controller->uses = array('ControllerPaginateModel');
		$Controller->params['url'] = array();
		$Controller->constructClasses();
		$Controller->paginate = array(
			'ControllerPaginateModel' => array('contain' => array('ControllerPaginateModel'), 'group' => 'Comment.author_id')
		);
		$result = $Controller->paginate('ControllerPaginateModel');
		$expected = array('contain' => array('ControllerPaginateModel'), 'group' => 'Comment.author_id');
		$this->assertEqual($Controller->ControllerPaginateModel->extra, $expected);
		$this->assertEqual($Controller->ControllerPaginateModel->extraCount, $expected);

		$Controller->paginate = array(
			'ControllerPaginateModel' => array('foo', 'contain' => array('ControllerPaginateModel'), 'group' => 'Comment.author_id')
		);
		$Controller->paginate('ControllerPaginateModel');
		$expected = array('contain' => array('ControllerPaginateModel'), 'group' => 'Comment.author_id', 'type' => 'foo');
		$this->assertEqual($Controller->ControllerPaginateModel->extra, $expected);
		$this->assertEqual($Controller->ControllerPaginateModel->extraCount, $expected);
	}

/**
 * testPaginatePassedArgs method
 *
 * @return void
 */
	public function testPaginatePassedArgs() {
		$Controller = new Controller();
		$Controller->uses = array('ControllerPost');
		$Controller->passedArgs[] = array('1', '2', '3');
		$Controller->params['url'] = array();
		$Controller->constructClasses();

		$Controller->paginate = array(
			'fields' => array(),
			'order' => '',
			'limit' => 5,
			'page' => 1,
			'recursive' => -1
		);
		$conditions = array();
		$Controller->paginate('ControllerPost',$conditions);

		$expected = array(
			'fields' => array(),
			'order' => '',
			'limit' => 5,
			'page' => 1,
			'recursive' => -1,
			'conditions' => array()
		);
		$this->assertEqual($Controller->params['paging']['ControllerPost']['options'],$expected);
	}

/**
 * Test that special paginate types are called and that the type param doesn't leak out into defaults or options.
 *
 * @return void
 */
	function testPaginateSpecialType() {
		$Controller = new Controller();
		$Controller->uses = array('ControllerPost', 'ControllerComment');
		$Controller->passedArgs[] = '1';
		$Controller->params['url'] = array();
		$Controller->constructClasses();

		$Controller->paginate = array('ControllerPost' => array('popular', 'fields' => array('id', 'title')));
		$result = $Controller->paginate('ControllerPost');

		$this->assertEqual(Set::extract($result, '{n}.ControllerPost.id'), array(2, 3));
		$this->assertEqual($Controller->ControllerPost->lastQuery['conditions'], array('ControllerPost.id > ' => '1'));
		$this->assertFalse(isset($Controller->params['paging']['ControllerPost']['defaults'][0]));
		$this->assertFalse(isset($Controller->params['paging']['ControllerPost']['options'][0]));
	}

/**
 * testDefaultPaginateParams method
 *
 * @access public
 * @return void
 */
	function testDefaultPaginateParams() {
		$Controller = new Controller();
		$Controller->modelClass = 'ControllerPost';
		$Controller->params['url'] = array();
		$Controller->paginate = array('order' => 'ControllerPost.id DESC');
		$Controller->constructClasses();
		$results = Set::extract($Controller->paginate('ControllerPost'), '{n}.ControllerPost.id');
		$this->assertEqual($Controller->params['paging']['ControllerPost']['defaults']['order'], 'ControllerPost.id DESC');
		$this->assertEqual($Controller->params['paging']['ControllerPost']['options']['order'], 'ControllerPost.id DESC');
		$this->assertEqual($results, array(3, 2, 1));
	}

/**
 * test paginate() and virtualField interactions
 *
 * @return void
 */
	function testPaginateOrderVirtualField() {
		$Controller = new Controller();
		$Controller->uses = array('ControllerPost', 'ControllerComment');
		$Controller->params['url'] = array();
		$Controller->constructClasses();
		$Controller->ControllerPost->virtualFields = array(
			'offset_test' => 'ControllerPost.id + 1'
		);

		$Controller->paginate = array(
			'fields' => array('id', 'title', 'offset_test'),
			'order' => array('offset_test' => 'DESC')
		);
		$result = $Controller->paginate('ControllerPost');
		$this->assertEqual(Set::extract($result, '{n}.ControllerPost.offset_test'), array(4, 3, 2));

		$Controller->passedArgs = array('sort' => 'offset_test', 'direction' => 'asc');
		$result = $Controller->paginate('ControllerPost');
		$this->assertEqual(Set::extract($result, '{n}.ControllerPost.offset_test'), array(2, 3, 4));
	}

/**
 * testFlash method
 *
 * @access public
 * @return void
 */
	function testFlash() {
		$Controller = new Controller();
		$Controller->flash('this should work', '/flash');
		$result = $Controller->output;

		$expected = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>this should work</title>
		<style><!--
		P { text-align:center; font:bold 1.1em sans-serif }
		A { color:#444; text-decoration:none }
		A:HOVER { text-decoration: underline; color:#44E }
		--></style>
		</head>
		<body>
		<p><a href="/flash">this should work</a></p>
		</body>
		</html>';
		$result = str_replace(array("\t", "\r\n", "\n"), "", $result);
		$expected =  str_replace(array("\t", "\r\n", "\n"), "", $expected);
		$this->assertEqual($result, $expected);

		App::build(array('views' => array(TEST_CAKE_CORE_INCLUDE_PATH . 'tests' . DS . 'test_app' . DS . 'views'. DS)));
		$Controller = new Controller();
		$Controller->flash('this should work', '/flash', 1, 'ajax2');
		$result = $Controller->output;
		$this->assertPattern('/Ajax!/', $result);
		App::build();
	}

/**
 * testControllerSet method
 *
 * @access public
 * @return void
 */
	function testControllerSet() {
		$Controller = new Controller();
		$Controller->set('variable_with_underscores', null);
		$this->assertTrue(array_key_exists('variable_with_underscores', $Controller->viewVars));

		$Controller->viewVars = array();
		$viewVars = array('ModelName' => array('id' => 1, 'name' => 'value'));
		$Controller->set($viewVars);
		$this->assertTrue(array_key_exists('ModelName', $Controller->viewVars));

		$Controller->viewVars = array();
		$Controller->set('variable_with_underscores', 'value');
		$this->assertTrue(array_key_exists('variable_with_underscores', $Controller->viewVars));

		$Controller->viewVars = array();
		$viewVars = array('ModelName' => 'name');
		$Controller->set($viewVars);
		$this->assertTrue(array_key_exists('ModelName', $Controller->viewVars));

		$Controller->set('title', 'someTitle');
		$this->assertIdentical($Controller->viewVars['title'], 'someTitle');
		$this->assertTrue(empty($Controller->pageTitle));

		$Controller->viewVars = array();
		$expected = array('ModelName' => 'name', 'ModelName2' => 'name2');
		$Controller->set(array('ModelName', 'ModelName2'), array('name', 'name2'));
		$this->assertIdentical($Controller->viewVars, $expected);
	}

/**
 * testRender method
 *
 * @access public
 * @return void
 */
	function testRender() {
		App::build(array(
			'views' => array(TEST_CAKE_CORE_INCLUDE_PATH . 'tests' . DS . 'test_app' . DS . 'views'. DS)
		), true);

		$Controller = new Controller();
		$Controller->viewPath = 'posts';

		$result = $Controller->render('index');
		$this->assertPattern('/posts index/', $result);

		$result = $Controller->render('/elements/test_element');
		$this->assertPattern('/this is the test element/', $result);

		$Controller = new TestController();
		$Controller->constructClasses();
		$Controller->ControllerComment->validationErrors = array('title' => 'tooShort');
		$expected = $Controller->ControllerComment->validationErrors;

		ClassRegistry::flush();
		$Controller->viewPath = 'posts';
		$result = $Controller->render('index');
		$View = ClassRegistry::getObject('view');
		$this->assertTrue(isset($View->validationErrors['ControllerComment']));
		$this->assertEqual($expected, $View->validationErrors['ControllerComment']);

		$Controller->ControllerComment->validationErrors = array();
		ClassRegistry::flush();

		App::build();
	}

/**
 * test that a component beforeRender can change the controller view class.
 *
 * @return void
 */
	function testComponentBeforeRenderChangingViewClass() {
		$core = App::core('views');
		App::build(array(
			'views' => array(
				TEST_CAKE_CORE_INCLUDE_PATH . 'tests' . DS . 'test_app' . DS . 'views'. DS,
				$core[0]
			)
		), true);
		$Controller =& new Controller();
		$Controller->uses = array();
		$Controller->components = array('Test');
		$Controller->constructClasses();
		$Controller->Test->viewclass = 'Theme';
		$Controller->viewPath = 'posts';
		$Controller->theme = 'test_theme';
		$result = $Controller->render('index');
		$this->assertPattern('/default test_theme layout/', $result);
		App::build();
	}

/**
 * testToBeInheritedGuardmethods method
 *
 * @access public
 * @return void
 */
	function testToBeInheritedGuardmethods() {
		$Controller = new Controller();
		$this->assertTrue($Controller->_beforeScaffold(''));
		$this->assertTrue($Controller->_afterScaffoldSave(''));
		$this->assertTrue($Controller->_afterScaffoldSaveError(''));
		$this->assertFalse($Controller->_scaffoldError(''));
	}

/**
 * Generates status codes for redirect test.
 *
 * @return void
 */
	public static function statusCodeProvider() {
		return array(
			array(100, "Continue"),
			array(101, "Switching Protocols"),
			array(200, "OK"),
			array(201, "Created"),
			array(202, "Accepted"),
			array(203, "Non-Authoritative Information"),
			array(204, "No Content"),
			array(205, "Reset Content"),
			array(206, "Partial Content"),
			array(300, "Multiple Choices"),
			array(301, "Moved Permanently"),
			array(302, "Found"),
			array(303, "See Other"),
			array(304, "Not Modified"),
			array(305, "Use Proxy"),
			array(307, "Temporary Redirect"),
			array(400, "Bad Request"),
			array(401, "Unauthorized"),
			array(402, "Payment Required"),
			array(403, "Forbidden"),
			array(404, "Not Found"),
			array(405, "Method Not Allowed"),
			array(406, "Not Acceptable"),
			array(407, "Proxy Authentication Required"),
			array(408, "Request Time-out"),
			array(409, "Conflict"),
			array(410, "Gone"),
			array(411, "Length Required"),
			array(412, "Precondition Failed"),
			array(413, "Request Entity Too Large"),
			array(414, "Request-URI Too Large"),
			array(415, "Unsupported Media Type"),
			array(416, "Requested range not satisfiable"),
			array(417, "Expectation Failed"),
			array(500, "Internal Server Error"),
			array(501, "Not Implemented"),
			array(502, "Bad Gateway"),
			array(503, "Service Unavailable"),
			array(504, "Gateway Time-out"),
		);
	}

/**
 * testRedirect method
 *
 * @dataProvider statusCodeProvider
 * @access public
 * @return void
 */
	function testRedirectByCode($code, $msg) {
		$Controller = $this->getMock('Controller', array('header'));

		$Controller->Components = $this->getMock('ComponentCollection');
		$Controller->expects($this->at(0))->method('header')
			->with("HTTP/1.1 {$code} {$msg}");

		$Controller->expects($this->at(1))->method('header')
			->with('Location: http://cakephp.org');

		$Controller->expects($this->exactly(2))->method('header');

		$Controller->redirect('http://cakephp.org', (int)$code, false);
		$this->assertFalse($Controller->autoRender);
	}

/**
 * test redirecting by message
 *
 * @dataProvider statusCodeProvider
 * @return void
 */
	function testRedirectByMessage($code, $msg) {
		$Controller = $this->getMock('Controller', array('header'));

		$Controller->Components = $this->getMock('ComponentCollection');

		$Controller->expects($this->at(0))->method('header')
			->with("HTTP/1.1 {$code} {$msg}");

		$Controller->expects($this->at(1))->method('header')
			->with('Location: http://cakephp.org');

		$Controller->expects($this->exactly(2))->method('header');
		$Controller->redirect('http://cakephp.org', $msg, false);
		$this->assertFalse($Controller->autoRender);
	}

/**
 * test that redirect triggers methods on the components.
 *
 * @return void
 */
	function testRedirectTriggeringComponentsReturnNull() {
		$Controller = $this->getMock('Controller', array('header'));
		$Controller->Components = $this->getMock('ComponentCollection');

		$Controller->Components->expects($this->once())->method('trigger')
			->will($this->returnValue(null));

		$Controller->expects($this->at(0))->method('header')
			->with('HTTP/1.1 301 Moved Permanently');

		$Controller->expects($this->at(1))->method('header')
			->with('Location: http://cakephp.org');

		$Controller->redirect('http://cakephp.org', 301, false);
	}

/**
 * test that beforeRedirect callback returnning null doesn't affect things.
 *
 * @return void
 */
	function testRedirectBeforeRedirectModifyingParams() {
		$Controller = $this->getMock('Controller', array('header'));
		$Controller->Components = $this->getMock('ComponentCollection');

		$Controller->Components->expects($this->once())->method('trigger')
			->will($this->returnValue(array('http://book.cakephp.org')));

		$Controller->expects($this->at(0))->method('header')
			->with('HTTP/1.1 301 Moved Permanently');

		$Controller->expects($this->at(1))->method('header')
			->with('Location: http://book.cakephp.org');

		$Controller->redirect('http://cakephp.org', 301, false);
	}

/**
 * testMergeVars method
 *
 * @access public
 * @return void
 */
	function testMergeVars() {
		if ($this->skipIf(defined('APP_CONTROLLER_EXISTS'), '%s Need a non-existent AppController')) {
			return;
		}

		$TestController = new TestController();
		$TestController->constructClasses();

		$testVars = get_class_vars('TestController');
		$appVars = get_class_vars('AppController');

		$components = is_array($appVars['components'])
						? array_merge($appVars['components'], $testVars['components'])
						: $testVars['components'];
		if (!in_array('Session', $components)) {
			$components[] = 'Session';
		}
		$helpers = is_array($appVars['helpers'])
					? array_merge($appVars['helpers'], $testVars['helpers'])
					: $testVars['helpers'];
		$uses = is_array($appVars['uses'])
					? array_merge($appVars['uses'], $testVars['uses'])
					: $testVars['uses'];

		$this->assertEqual(count(array_diff($TestController->helpers, $helpers)), 0);
		$this->assertEqual(count(array_diff($TestController->uses, $uses)), 0);
		$this->assertEqual(count(array_diff_assoc(Set::normalize($TestController->components), Set::normalize($components))), 0);

		$TestController = new AnotherTestController();
		$TestController->constructClasses();

		$appVars = get_class_vars('AppController');
		$testVars = get_class_vars('AnotherTestController');


		$this->assertTrue(in_array('ControllerPost', $appVars['uses']));
		$this->assertNull($testVars['uses']);

		$this->assertFalse(isset($TestController->ControllerPost));


		$TestController = new ControllerCommentsController();
		$TestController->constructClasses();

		$appVars = get_class_vars('AppController');
		$testVars = get_class_vars('ControllerCommentsController');


		$this->assertTrue(in_array('ControllerPost', $appVars['uses']));
		$this->assertEqual(array('ControllerPost'), $testVars['uses']);

		$this->assertTrue(isset($TestController->ControllerPost));
		$this->assertTrue(isset($TestController->ControllerComment));
	}

/**
 * test that options from child classes replace those in the parent classes.
 *
 * @access public
 * @return void
 */
	function testChildComponentOptionsSupercedeParents() {
		if ($this->skipIf(defined('APP_CONTROLLER_EXISTS'), '%s Need a non-existent AppController')) {
			return;
		}
		$TestController = new TestController();
		$expected = array('foo');
		$TestController->components = array('Cookie' => $expected);
		$TestController->constructClasses();
		$this->assertEqual($TestController->components['Cookie'], $expected);
	}

/**
 * Ensure that __mergeVars is not being greedy and merging with
 * AppController when you make an instance of Controller
 *
 * @return void
 */
	function testMergeVarsNotGreedy() {
		$Controller = new Controller();
		$Controller->components = array();
		$Controller->uses = array();
		$Controller->constructClasses();

		$this->assertFalse(isset($Controller->Session));
	}

/**
 * testReferer method
 *
 * @access public
 * @return void
 */
	function testReferer() {
		$Controller = new Controller();
		$_SERVER['HTTP_REFERER'] = 'http://cakephp.org';
		$result = $Controller->referer(null, false);
		$expected = 'http://cakephp.org';
		$this->assertIdentical($result, $expected);

		$_SERVER['HTTP_REFERER'] = '';
		$result = $Controller->referer('http://cakephp.org', false);
		$expected = 'http://cakephp.org';
		$this->assertIdentical($result, $expected);

		$_SERVER['HTTP_REFERER'] = '';
		$referer = array(
			'controller' => 'pages',
			'action' => 'display',
			'home'
		);
		$result = $Controller->referer($referer, false);
		$expected = 'http://' . env('HTTP_HOST') . '/pages/display/home';
		$this->assertIdentical($result, $expected);

		$_SERVER['HTTP_REFERER'] = '';
		$result = $Controller->referer(null, false);
		$expected = '/';
		$this->assertIdentical($result, $expected);

		$_SERVER['HTTP_REFERER'] = FULL_BASE_URL.$Controller->webroot.'/some/path';
		$result = $Controller->referer(null, false);
		$expected = '/some/path';
		$this->assertIdentical($result, $expected);

		$Controller->webroot .= '/';
		$_SERVER['HTTP_REFERER'] = FULL_BASE_URL.$Controller->webroot.'/some/path';
		$result = $Controller->referer(null, false);
		$expected = '/some/path';
		$this->assertIdentical($result, $expected);

		$_SERVER['HTTP_REFERER'] = FULL_BASE_URL.$Controller->webroot.'some/path';
		$result = $Controller->referer(null, false);
		$expected = '/some/path';
		$this->assertIdentical($result, $expected);

		$Controller->webroot = '/recipe/';

		$_SERVER['HTTP_REFERER'] = FULL_BASE_URL.$Controller->webroot.'recipes/add';
		$result = $Controller->referer();
		$expected = '/recipes/add';
		$this->assertIdentical($result, $expected);
	}

/**
 * testSetAction method
 *
 * @access public
 * @return void
 */
	function testSetAction() {
		$TestController = new TestController();
		$TestController->setAction('index', 1, 2);
		$expected = array('testId' => 1, 'test2Id' => 2);
		$this->assertidentical($TestController->data, $expected);
	}

/**
 * testUnimplementedIsAuthorized method
 *
 * @expectedException PHPUnit_Framework_Error
 * @access public
 * @return void
 */
	function testUnimplementedIsAuthorized() {
		$TestController = new TestController();
		$TestController->isAuthorized();
	}

/**
 * testValidateErrors method
 *
 * @access public
 * @return void
 */
	function testValidateErrors() {
		$TestController = new TestController();
		$TestController->constructClasses();
		$this->assertFalse($TestController->validateErrors());
		$this->assertEqual($TestController->validate(), 0);

		$TestController->ControllerComment->invalidate('some_field', 'error_message');
		$TestController->ControllerComment->invalidate('some_field2', 'error_message2');
		$comment =& new ControllerComment();
		$comment->set('someVar', 'data');
		$result = $TestController->validateErrors($comment);
		$expected = array('some_field' => 'error_message', 'some_field2' => 'error_message2');
		$this->assertIdentical($result, $expected);
		$this->assertEqual($TestController->validate($comment), 2);
	}

/**
 * test that validateErrors works with any old model.
 *
 * @return void
 */
	function testValidateErrorsOnArbitraryModels() {
		$TestController =& new TestController();

		$Post = new ControllerPost();
		$Post->validate = array('title' => 'notEmpty');
		$Post->set('title', '');
		$result = $TestController->validateErrors($Post);

		$expected = array('title' => 'This field cannot be left blank');
		$this->assertEqual($result, $expected);
	}

/**
 * testPostConditions method
 *
 * @access public
 * @return void
 */
	function testPostConditions() {
		$Controller = new Controller();


		$data = array(
			'Model1' => array('field1' => '23'),
			'Model2' => array('field2' => 'string'),
			'Model3' => array('field3' => '23'),
		);
		$expected = array(
			'Model1.field1' => '23',
			'Model2.field2' => 'string',
			'Model3.field3' => '23',
		);
		$result = $Controller->postConditions($data);
		$this->assertIdentical($result, $expected);


		$data = array();
		$Controller->data = array(
			'Model1' => array('field1' => '23'),
			'Model2' => array('field2' => 'string'),
			'Model3' => array('field3' => '23'),
		);
		$expected = array(
			'Model1.field1' => '23',
			'Model2.field2' => 'string',
			'Model3.field3' => '23',
		);
		$result = $Controller->postConditions($data);
		$this->assertIdentical($result, $expected);


		$data = array();
		$Controller->data = array();
		$result = $Controller->postConditions($data);
		$this->assertNull($result);


		$data = array();
		$Controller->data = array(
			'Model1' => array('field1' => '23'),
			'Model2' => array('field2' => 'string'),
			'Model3' => array('field3' => '23'),
		);
		$ops = array(
			'Model1.field1' => '>',
			'Model2.field2' => 'LIKE',
			'Model3.field3' => '<=',
		);
		$expected = array(
			'Model1.field1 >' => '23',
			'Model2.field2 LIKE' => "%string%",
			'Model3.field3 <=' => '23',
		);
		$result = $Controller->postConditions($data, $ops);
		$this->assertIdentical($result, $expected);
	}

/**
 * testControllerHttpCodes method
 *
 * @access public
 * @return void
 */
	function testControllerHttpCodes() {
		$Controller = new Controller();
		$result = $Controller->httpCodes();
		$this->assertEqual(count($result), 39);

		$result = $Controller->httpCodes(100);
		$expected = array(100 => 'Continue');
		$this->assertEqual($result, $expected);

		$codes = array(
			1337 => 'Undefined Unicorn',
			1729 => 'Hardy-Ramanujan Located'
		);

		$result = $Controller->httpCodes($codes);
		$this->assertTrue($result);
		$this->assertEqual(count($Controller->httpCodes()), 41);

		$result = $Controller->httpCodes(1337);
		$expected = array(1337 => 'Undefined Unicorn');
		$this->assertEqual($result, $expected);

		$codes = array(404 => 'Sorry Bro');
		$result = $Controller->httpCodes($codes);
		$this->assertTrue($result);
		$this->assertEqual(count($Controller->httpCodes()), 41);

		$result = $Controller->httpCodes(404);
		$expected = array(404 => 'Sorry Bro');
		$this->assertEqual($result, $expected);
	}

/**
 * Tests that the startup process calls the correct functions
 *
 * @access public
 * @return void
 */
	function testStartupProcess() {
		$Controller = $this->getMock('Controller', array('beforeFilter', 'afterFilter'));

		$Controller->components = array('MockStartup');
		$Controller->Components = $this->getMock('ComponentCollection');

		$Controller->expects($this->once())->method('beforeFilter');
		$Controller->Components->expects($this->at(0))->method('trigger')
			->with('initialize', array(&$Controller));

		$Controller->Components->expects($this->at(1))->method('trigger')
			->with('startup', array(&$Controller));

		$Controller->startupProcess();
	}
/**
 * Tests that the shutdown process calls the correct functions
 *
 * @access public
 * @return void
 */
	function testShutdownProcess() {
		$Controller = $this->getMock('Controller', array('beforeFilter', 'afterFilter'));

		$Controller->components = array('MockShutdown');
		$Controller->Components = $this->getMock('ComponentCollection');

		$Controller->expects($this->once())->method('afterFilter');
		$Controller->Components->expects($this->once())->method('trigger')
			->with('shutdown', array(&$Controller));

		$Controller->shutdownProcess();
	}
}
