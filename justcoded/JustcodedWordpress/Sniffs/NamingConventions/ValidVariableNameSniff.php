<?php
/**
 * WordPress Coding Standard.
 *
 * @package WPCS\WordPressCodingStandards
 * @link    https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

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
class JustcodedWordpress_Sniffs_NamingConventions_ValidVariableNameSniff extends \WordPress\Sniffs\NamingConventions\ValidVariableNameSniff
{

    /**
     * List of member variables that can have mixed case.
     *
     * @since 0.9.0
     * @since 0.11.0 Changed from public to protected.
     *
     * @var array
     */
    protected $whitelisted_mixed_case_member_var_names = array(
        'ID'                => true,
        'comment_ID'        => true,
        'comment_post_ID'   => true,
        'post_ID'           => true,
        'comment_author_IP' => true,
        'cat_ID'            => true,

        'SLUG'              => true,
        'TITLE'             => true,
    );

}
