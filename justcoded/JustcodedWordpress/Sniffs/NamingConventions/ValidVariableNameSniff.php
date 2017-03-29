<?php
/**
 * WordPress Coding Standard.
 *
 * @package WPCS\WordPressCodingStandards
 * @link    https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

if ( ! class_exists( 'WordPress_Sniffs_NamingConventions_ValidVariableNameSniff', true ) ) {
	throw new PHP_CodeSniffer_Exception( 'Class WordPress_Sniffs_NamingConventions_ValidVariableNameSniff not found' );
}

/**
 * Checks the naming of variables and member variables.
 *
 * @link    https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/#naming-conventions
 *
 * @package WPCS\WordPressCodingStandards
 *
 * @since   0.9.0
 *
 * Last synced with base class July 2014 at commit ed257ca0e56ad86cd2a4d6fa38ce0b95141c824f.
 * @link    https://github.com/squizlabs/PHP_CodeSniffer/blob/master/CodeSniffer/Standards/Squiz/Sniffs/NamingConventions/ValidVariableNameSniff.php
 */
class JustcodedWordpress_Sniffs_NamingConventions_ValidVariableNameSniff extends WordPress_Sniffs_NamingConventions_ValidVariableNameSniff
{

	/**
	 * Custom list of variables which can have mixed case.
	 *
	 * @since 0.10.0
	 *
	 * @var string[]
	 */
	public $customPropertiesWhitelist = array(
		'SLUG',
		'TITLE',
	);

}
