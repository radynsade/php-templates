<?php

/**
 * PHP Templates.
 * 
 * Copyright (c) 2023, Nikita Prokopenko radynje@gmail.com
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE. 
 */

namespace Radynsade\PhpTemplates;

abstract class Template {
	/**
	 * Root directory to search templates.
	 * @var string
	 */
	public static string $root = '';

	/**
	 * Read the template and return result into a variable.
	 * @param string $path without extension at the end.
	 * @param array $variables
	 * @return string
	 */
	public static function read(
		string $path,
		array $variables
	): string {
		foreach ($variables as $name => $value) {
			${$name} = $value;
		}

		ob_start();

		$fullPath = !empty(self::$root)
			? self::joinPaths([self::$root, $path])
			: $path;

		$phtml = $fullPath . '.phtml';

		if (file_exists($phtml)) {
			require $phtml;
		} else {
			require $fullPath . '.php';
		}

		$contents = ob_get_contents();

		ob_end_clean();

		return $contents;
	}

	/**
	 * Render template immediately.
	 * @param string $path without extension at the end.
	 * @param array $variables
	 * @return string
	 */
	public static function render(
		string $path,
		array $variables = []
	): void {
		foreach ($variables as $name => $value) {
			${$name} = $value;
		}

		ob_start();

		$fullPath = !empty(self::$root)
			? self::joinPaths([self::$root, $path])
			: $path;

		$phtml = $fullPath . '.phtml';

		if (file_exists($phtml)) {
			require $phtml;
		} else {
			require $fullPath . '.php';
		}
		
		ob_end_flush();
	}

	/**
	 * @param array $paths
	 * @return string
	 */
	private static function joinPaths(array $paths): string {
		return preg_replace(
			'#/+#',
			'/',
			implode('/', $paths)
		);
	}
}
