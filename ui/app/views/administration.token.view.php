<?php declare(strict_types=1);
/*
** Zabbix
** Copyright (C) 2001-2020 Zabbix SIA
**
** This program is free software; you can redistribute it and/or modify
** it under the terms of the GNU General Public License as published by
** the Free Software Foundation; either version 2 of the License, or
** (at your option) any later version.
**
** This program is distributed in the hope that it will be useful,
** but WITHOUT ANY WARRANTY; without even the implied warranty of
** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
** GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License
** along with this program; if not, write to the Free Software
** Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
**/


/**
 * @var CView $this
 */

$widget = (new CWidget())
	->setTitle(_('API tokens'))
	->setTitleSubmenu(getAdministrationGeneralSubmenu());

$token_form = (new CForm())
	->setId('token_form')
	->setName('token')
	->setAttribute('aria-labeledby', ZBX_STYLE_PAGE_TITLE);

$token_from_list = (new CFormList())
	->addRow(_('Name').':', $data['name'])
	->addRow(_('User').':', $data['user'])
	->addRow(_('Auth token').':', [
		$data['auth_token'],
		'&nbsp;',
		makeWarningIcon(
			_("Make shure to copy the auth token as you won't be able to view it after the page is closed.")
		),
		'&nbsp;',
		(new CLinkAction('Copy to clipboard'))->onClick('navigator.clipboard.writeText("'.$data['auth_token'].'")')
	])
	->addRow(_('Expires at'), ($data['expires_at'] == 0) ? '-' : date(ZBX_DATE_TIME, (int) $data['expires_at']))
	->addRow(_('Description').':', $data['description'])
	->addRow(new CLabel(_('Enabled').':', 'enabled'),
		(new CCheckBox('enabled'))
			->setChecked($data['status'] == ZBX_AUTH_TOKEN_ENABLED)
			->setEnabled(false)
	);

$token_view = (new CTabView())->addTab('token', _('Token'), $token_from_list);

$token_view->setFooter(makeFormFooter((new CRedirectButton(_('Close'), (new CUrl('zabbix.php'))
	->setArgument('action', 'token.list')
	->setArgument('page', CPagerHelper::loadPage('token.list', null))
))));

$token_form->addItem($token_view);
$widget
	->addItem($token_form)
	->show();
