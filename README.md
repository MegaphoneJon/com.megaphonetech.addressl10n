# Address format by Country

## Overview

This extension provides a user interface to edit country-specific postal mailing formats.  It does NOT provide a mechanism for automatically using those addresses on, e.g., mailing labels.  To do that, use the [CiviToken](https://civicrm.org/extensions/nzcofuzioncivitoken) extension with the "Address Block" token.

## Installation

This extension has no special installation requirements.  See the documentation for [installing a new extension](https://docs.civicrm.org/sysadmin/en/latest/customize/extensions/#installing-a-new-extension) if you haven't done it before.

## Usage
* To add/edit/delete address formats, go to **Administer menu » Localization » Country - Address Format**.
* Click the **Add Format** button to add a new country format.
* Click **Edit** or **Delete** next to an existing link to change it.

You will most likely want to set the mailing label format to `{address.address_block_text}` in **Administer menu » Localization » Address Settings** in order to take advantage of the country-specific mailing label formats.

### Credits
This extension has been developed and is being maintained by [Megaphone Technology Consulting](https://www.megaphonetech.com/) and is sponsored through the generosity of the [Armenian General Benevolent Union](https://www.agbu.org).
