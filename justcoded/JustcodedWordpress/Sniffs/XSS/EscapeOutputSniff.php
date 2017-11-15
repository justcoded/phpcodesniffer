<?php
/**
 * WordPress Coding Standard, Justcoded edition.
 */

/**
 * Verifies that all outputted strings are escaped.
 *
 * @link    http://codex.wordpress.org/Data_Validation Data Validation on WordPress Codex
 */
class JustcodedWordpress_Sniffs_XSS_EscapeOutputSniff extends \WordPress\Sniffs\XSS\EscapeOutputSniff {

	/**
	 * Custom list of functions which escape values for output.
	 *
	 * @since 0.5.0
	 *
	 * @var string[]
	 */
	public $customEscapingFunctions = array();

	/**
	 * Custom list of functions whose return values are pre-escaped for output.
	 *
	 * @since 0.3.0
	 *
	 * @var string[]
	 */
	public $customAutoEscapedFunctions = array(
		'cpt_prev_posts_link',
		'cpt_next_posts_link',
		'assets',
		'parent_assets',
	);

	/**
	 * Custom list of functions which escape values for output.
	 *
	 * @since      0.3.0
	 * @deprecated 0.5.0 Use $customEscapingFunctions instead.
	 * @see        WordPress_Sniffs_XSS_EscapeOutputSniff::$customEscapingFunctions
	 *
	 * @var string[]
	 */
	public $customSanitizingFunctions = array();

	/**
	 * Custom list of functions which print output incorporating the passed values.
	 *
	 * @since 0.4.0
	 *
	 * @var string[]
	 */
	public $customPrintingFunctions = array();

	/**
	 * Processes this test, when one of its tokens is encountered.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
	 * @param int                  $stackPtr  The position of the current token
	 *                                        in the stack passed in $tokens.
	 *
	 * @return int|void
	 */
	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$originStackPtr = $stackPtr;

		$filename = $phpcsFile->getFilename();
		$layout_view_pattern = 'views' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR;
		$this->tokens = $phpcsFile->getTokens();

		if (false !== strpos($filename, $layout_view_pattern)
			&& T_ECHO == $this->tokens[$stackPtr]['code']
		) {
			$next = $phpcsFile->findNext(
				PHP_CodeSniffer_Tokens::$emptyTokens,
				( $stackPtr + 1 ),
				null,
				true,
				null,
				true
			);
			if ( T_VARIABLE == $this->tokens[ $next ]['code'] && '$content' === $this->tokens[ $next ]['content'] ) {
				return;
			}
		}

		parent::process($phpcsFile, $originStackPtr);
	}

}
