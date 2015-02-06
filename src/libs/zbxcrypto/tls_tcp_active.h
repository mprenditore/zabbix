/*
** Zabbix
** Copyright (C) 2001-2015 Zabbix SIA
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

#ifndef ZABBIX_TLS_TCP_ACTIVE_H
#define ZABBIX_TLS_TCP_ACTIVE_H

typedef struct
{
	unsigned int	connection_type;	/* Values: ZBX_TCP_SEC_UNENCRYPTED, ZBX_TCP_SEC_TLS_PSK or */
						/* ZBX_TCP_SEC_TLS_CERT. */
#if defined(HAVE_POLARSSL) || defined(HAVE_GNUTLS) || defined(HAVE_OPENSSL)
	const char	*arg1;			/* For passing 'tls_issuer' or 'tls_psk_identity' depending */
						/* on the value of 'connection_type'. */
	size_t		arg1_len;
	const char	*arg2;			/* For passing 'tls_subject' or NULL depending on the value */
						/* of 'connection_type'. */
	size_t		arg2_len;
#endif
}
zbx_tls_conn_attr_t;

const char	*zbx_tls_connection_type_name(unsigned int type);
int		zbx_tls_get_attr(const zbx_sock_t *s, zbx_tls_conn_attr_t *attr);
int		DCcheck_proxy_permissions(const char *host, const zbx_tls_conn_attr_t *attr, zbx_uint64_t *hostid,
		char **error);

#endif	/* ZABBIX_TLS_TCP_ACTIVE_H */
