# "Frontend user login mode" - A rarely used TYPO3 functionality

The "frontend user login mode" functionality has been introduced to
TYPO3 by Kasper back in 2004 to overcome caching issues on typo3.org
and is rather an edge-case feature. Therefore, it is no longer part
of the TYPO3 Core from v12.0+ onwards, but available as an extension,
which solves the problem via modern techniques (using PSR-15 middlewares).

## So what does it do?

The extension adds a new TCA field ``fe_login_mode`` to the ``pages`` table.

Using this field one can define branches, which should behave like if a user
or user group is not logged in, even though the cookie - and the session - is
kept for other areas of a website. This is useful when trying to reduce the
amount of possible cache variants, especially in installations with complex
user and user group setups.

As previously available in the Core, the TypoScript option
``sendCacheHeaders_onlyWhenLoginDeniedInBranch`` can be used to
further restrict the transmission of cache headers.

## Installation

In case you update a TYPO3 installation from v11 to v12, you can use the
corresponding "Upgrade Wizard" in the TYPO3 install tool to fetch and install
the extension.

Otherwise, install the extension either via composer
`composer req o-ba/fe-login-mode` or download the extension from the
[TYPO3 Extension Repository](https://extensions.typo3.org/extension/fe_login_mode/)
and activate it in the Extension Manager of your TYPO3 installation.

## License

The extension is licensed under GPL v2+, same as the TYPO3 Core. For details
see the LICENSE file in this repository.

## Open Issues

If you find an issue, feel free to create an issue on GitHub or a pull request.

## Credits

This extension was created by [Oliver Bartsch](https://github.com/o-ba) in 2022.
The original credits go to the TYPO3 development team and the contributors, who
have maintained this code for over 18 years until it was removed from Core.
