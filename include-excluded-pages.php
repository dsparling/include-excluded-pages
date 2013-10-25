<?php
/**
 * @package IncludeExcludedPages
 */
/*
Plugin Name: Include Excluded Pages
Plugin URI: http://plugins.svn.wordpress.org/include-excluded-pages
Description: Include Excluded Pages will display the page name of an excluded page in the menu when (and only when) the user is on that page.
Version: 1.0.1
Author: Doug Sparling
Author URI: http://www.dougsparling.org
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

class IncludeExcludedPages {
	public function __construct() {
		add_filter( 'get_pages', array( $this, 'include_current_page_if_hidden' ), 1000 );
	}

	public function include_current_page_if_hidden( $pages ) {
		global $post;
		if ( !is_page() )
			return $pages;

		for ( $i = 0; $i < count( $pages ); $i++ ) {
			$included_ids[] = $pages[$i]->ID;
		}

		if ( !in_array( $post->ID, $included_ids ) ) {
			$pages[] = get_post( $post->ID );
		}
		return $pages;
	}
}

$includeExcludedPages = new IncludeExcludedPages();

?>
