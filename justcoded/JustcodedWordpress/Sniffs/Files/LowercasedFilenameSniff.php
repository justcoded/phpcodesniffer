<?php
/**
 * JustCoded_Sniffs_WordPress_Files_LowercasedFilenameSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @author    Alex Prokopenko <aprokopenko@justcoded.com>
 */

/**
 * Checks that all file names are lowercased.
 * Ignore classes which follows PSR autoload format.
 */
class JustcodedWordpress_Sniffs_Files_LowercasedFilenameSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * Returns an array of tokens this test wants to listen for.
	 *
	 * @return array
	 */
	public function register()
	{
		return array(T_OPEN_TAG);
	}

	/**
	 * Processes this sniff, when one of its tokens is encountered.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
	 * @param int $stackPtr The position of the current token in
	 *                                        the stack passed in $tokens.
	 *
	 * @return int
	 */
	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$filename = $phpcsFile->getFilename();
		if ($filename === 'STDIN') {
			return;
		}

		$filename = basename($filename);
		$lowercaseFilename = strtolower($filename);
		if ($filename !== $lowercaseFilename) {
			if (!$this->checkAutoloadNamespaceClass($phpcsFile, $stackPtr)) {
				$data = array(
					$filename,
					$lowercaseFilename,
				);
				$error = 'Filename "%s" doesn\'t match the expected filename "%s"';
				$phpcsFile->addError($error, $stackPtr, 'NotFound', $data);
				$phpcsFile->recordMetric($stackPtr, 'Lowercase filename', 'no');
			} else {
				$phpcsFile->recordMetric($stackPtr, 'Lowercase filename', 'no. psr-0 autoload detected');
			}
		} else {
			$phpcsFile->recordMetric($stackPtr, 'Lowercase filename', 'yes');
		}

		// Ignore the rest of the file.
		return ($phpcsFile->numTokens + 1);
	}

	/**
	 * Check that filename has namespace and class name is the same as filename.
	 * This means we have PSR0/PSR4 autoload enabled.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile
	 * @param int $stackPtr
	 *
	 * @return bool
	 */
	protected function checkAutoloadNamespaceClass(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$filename = $phpcsFile->getFilename();
		$tokens = $phpcsFile->getTokens();

		$in_namespace = false;
		$findTokens = array(
			T_CLASS,
			T_INTERFACE,
			T_TRAIT,
			T_NAMESPACE,
			T_CLOSE_TAG,
		);

		$stackPtr = $phpcsFile->findNext($findTokens, ($stackPtr + 1));
		while ($stackPtr !== false) {
			if ($tokens[$stackPtr]['code'] === T_CLOSE_TAG) {
				// if we reach here this means that we can't find namespace and class/interface/trait.
				return false;
			}

			// Keep track of what namespace we are in.
			if ($tokens[$stackPtr]['code'] === T_NAMESPACE) {
				$in_namespace = true;
			} else {
				// we're in declaration of class/interface/trait
				$nameToken = $phpcsFile->findNext(T_STRING, $stackPtr);
				$name = $tokens[$nameToken]['content'];

				$name_from_file = preg_replace('/\.php$/i', '', basename($filename));
				if (0 === strcmp($name_from_file, $name) && $in_namespace) {
					return true;
				} else {
					return false;
				}
			}

			$stackPtr = $phpcsFile->findNext($findTokens, ($stackPtr + 1));
		}

		return false;
	}
}
