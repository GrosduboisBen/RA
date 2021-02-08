# Documentation module FDI-RES1

## Étape 1

---
### Réalisation d'un schéma du réseau :

J'ai réalisé, un schéma représentant mon réseau pleinement configuré.

### Création de la VM template :

J'ai créé une machine virtuelle type, servant de base à la création des machines nécessaires au réseau.

Voici le Template type :

- **Hostname :** Template
- **CPU :** 1 Cœur
- **RAM :** 2 Go
- **OS :** Debian Buster
- **Carte réseau :** Host Only

J'ai ensuite installé Debian sans GUI via son .iso sur VirtualBox, en n'incluant que les collections "SSH" et "standard system utilities".

## Étape 2

---

### Créations des VMs  :

On clone la VM template en 4 autres machines virtuelles : *Gateway*, *Manager*, *Web* et *Client* que l'on configurera différemment selon leurs rôles.

Par une connection  SSH afin de modifier le hostname de chaque système en fonction de son rôle. Pour cela, on entre la  commande :

```
hostnamectl set-hostname <nouveau-hostname>
```

En remplaçant *<nouveau-hostname>* par le rôle de la machine.

## Étape 3

---

### Configuration des cartes réseaux :

Sur la VM *gateway*, Deux configurations de cartes réseau sont à mettre en place : La  première *(enp0s3)* en *bridge*, et la seconde *(enp0s8)* en host-only.Il faut pour cela  éditer le fichier de configuration d' interfaces dans **/etc/network/interfaces**.

Je vais donc modifier la configuration de l'interface **enp0s8** en lui donnant une addresse IP *statique*, et initialiser l'autre interface réseau (**enp0s3**).

Le fichier ressemblera donc au code ci-dessous après les modifications : 

```
# This file describes the network interfaces available on your system
# and how to activate them. For more information, see interfaces(5).

source /etc/network/interfaces.d/*

# The loopback network interface
auto lo
iface lo inet loopback

# The primary network interface
allow-hotplug enp0s3
iface enp0s8 inet dhcp
allow-hotplug enp0s8
iface enp0s8 inet static
    address 10.242.0.1
    netmask 255.255.0.0
```

L'opération devra être répétée pour chaque VM afin que leurs IPs soit statiques et distinctes.

Pour *manager*, j'ai choisi l'adresse **10.242.0.2**.

Un **gateway** a été configuré, avec l'adresse IP de ma VM *gateway*.

Nous pouvons désormais ping chaque machine virtuelle depuis n'importe laquelle de celle-ci, mais ne pouvons acceder à internet que depuis *gateway*.

## Étape 4

---

### Configuration du *port-forwarding* :

Pour que les VMs puissent avoir accès à internet via *gateway*, on définit une nouvelle règle aux **iptables** de la VM *gateway*. 

Il nous faut pour cela activer le port-forwarding en décommentant la ligne suivante dans le fichier **/etc/sysctl.conf** de la Vm *gateway*: 

```
net.ipv4.ip_forward = 1
```

Après avoir redémarré la Vm,on entre la commande suivante afin de vérifier la prise en compte des changements : 

``` 
sysctl -p
```

### Configuration des *iptables* :

Cette étape consiste à mettre en place une règle pour permettre aux autres VM de se connecter à internet via la *gateway*.

Nous utiliserons **MASQUERADE**, car notre carte bridge est configurée avec une adresse IP dynamique (DHCP).

On teste donc avec cette commande : 

```
iptables -t nat -A POSTROUTING ! -d 10.242.0.0/16 -o enp0s3 -j MASQUERADE 
```

Ici, `enp0s3` est ma carte réseau bridge, et `10.242.0.0/16` la plage réseau où je souhaite rediriger le connexion internet.

Afin que le serveur google.com soit bien reconnu , nous allons modifier le ficihier **/etc/resolv.conf** en y entrant la ligne suivante :
```
nameserver 8.8.8.8
```

Sur la VM *web*, je teste donc la commande :

``` 
ping google.com 
```

Et j'obtiens : 

```
PING google.com (216.58.201.238) 56(84) bytes of data.
64 bytes from par10s33-in-f14.1e100.net (216.58.201.238): icmp_seq=1 ttl=116 time=314 ms
64 bytes from par10s33-in-f14.1e100.net (216.58.201.238): icmp_seq=2 ttl=116 time=5.75 ms
64 bytes from par10s33-in-f14.1e100.net (216.58.201.238): icmp_seq=3 ttl=116 time=5.66 ms
64 bytes from par10s33-in-f14.1e100.net (216.58.201.238): icmp_seq=4 ttl=116 time=5.21 ms
64 bytes from par10s33-in-f14.1e100.net (216.58.201.238): icmp_seq=5 ttl=116 time=5.53 ms
^C
--- google.com ping statistics ---
5 packets transmitted, 5 received, 0% packet loss, time 11ms
rtt min/avg/max/mdev = 5.212/67.200/313.843/123.321 ms
```


### Faire en sorte que la règle soit persistente :

Il faut maintenant faire en sorte de conserver cette règle à chaque redémarrage de la machine.

Pour cela, j'installe *iptables-persistent*. Celui-ci va se charger d'enregistrer les règles établies et de les charger au démarrage de la machine.

Une fois la règle établie, on lance la commande : 

```
iptables-save > /etc/iptables/rules.v4
```

La (ou les) règle(s) établie(s) est donc maintenant persistent.

## Étape 5

---

### Installer un serveur DHCP :

Sur la VM *manager*, nous allons installer un *serveur DHCP* afin d'administrer les connexions des autres machines. Les dix premières adresses sont réservées aux  équipements, tandis que les 27 suivantes sont réservées aux machines fixes.

Notre DHCP assignera  des IPs allant de *10.242.0.38* à *10.242.255.254*.

Pour installer notre serveur, on rentre la commande suivante : 

```
apt install isc-dhcp-server
```


### Configuration du serveur DHCP :

On se rend dans le fichier **/etc/dhcp/dhcpd.conf** afin de modifier les paramètres de notre serveur.

Nous allons effectuer quelques modifications : 

+ On commente la  ligne `option domain-name "example.org";`
+ On remplace `ns1.example.org, ns2.example.org;` par `8.8.8.8` ,qui nous servira ici de DNS.
+ On décommente la ligne `#authoritative;` car on souhaite que ce soit le seul server DHCP sur notre réseau.

On peut maintenant initialiser notre subnet :

```
subnet 10.242.0.0 netmask 255.255.0.0 {
	option routers 10.242.0.1;
	range 10.242.0.38 10.242.255.254;
}
```

Ce qui nous donne donc : 

```
# dhcpd.conf
#
# Sample configuration file for ISC dhcpd
#

# option definitions common to all supported networks...
# option domain-name "example.org";
option domain-name-servers 8.8.8.8;

default-lease-time 600;
max-lease-time 7200;

# The ddns-updates-style parameter controls whether or not the server will
# attempt to do a DNS update when a lease is confirmed. We default to the
# behavior of the version 2 packages ('none', since DHCP v2 didn't
# have support for DDNS.)
ddns-update-style none;

# If this DHCP server is the official DHCP server for the local
# network, the authoritative directive should be uncommented.
authoritative;

# Use this to send dhcp log messages to a different log file (you also
# have to hack syslog.conf to complete the redirection).
#log-facility local7;

# No service will be given on this subnet, but declaring it helps the 
# DHCP server to understand the network topology.

subnet 10.242.0.0 netmask 255.255.0.0 {         # Définition de l' IP et du subnet mask
	option routers 10.242.0.1;                  # Définition de l'IP de routing,soit notre gateway
	range 10.242.0.38 10.242.255.254;           # On définit enfin notre intervale.
}
```


### Test sur un client :

On configure l'interface de la VM *client* en DHCP.
On lance ensuite la commande `ip a` :

```
benoit@client:~$ ip a

1: lo: <LOOPBACK,UP,LOWER_UP> mtu 65536 qdisc noqueue state UNKNOWN group default qlen 1000
    link/loopback 00:00:00:00:00:00 brd 00:00:00:00:00:00
    inet 127.0.0.1/8 scope host lo
       valid_lft forever preferred_lft forever
    inet6 ::1/128 scope host 
       valid_lft forever preferred_lft forever
2: enp0s3: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc pfifo_fast state UP group default qlen 1000
    link/ether 08:00:27:ef:17:32 brd ff:ff:ff:ff:ff:ff
    inet 10.242.0.38/16 brd 10.242.255.255 scope global dynamic enp0s3
       valid_lft 558sec preferred_lft 558sec
    inet6 fe80::a00:27ff:feef:1732/64 scope link 
       valid_lft forever preferred_lft forever

```

L'adresse IP de **enp0s3** est bien comprise dans la range désirée.


## Étape 6

---

Nous allons définir l'accès par SSH depuis *gateway* vers toute les autres machines.

### Génération de la clé SSH :

On rentre la commande suivante dans la VM *gateway*

```
ssh-keygen -t ed25519 -C "username"
```

Deux clefs sont crées : une privée : **~/.ssh/id_ed25519** ,et une publique : **~/.ssh/id_ed25519.pub**. Nous n'utiliserons que la publique.

### Configuration des autres VM :

On se connecte maintenant sur une autre machine, à laquelle on désire avoir accès sans mot de passe.

On se rend ensuite dans **~/.ssh et on crée un fichier **authorized_keys**.

On l'ouvre avec un éditeur de texte (ex. `emacs`) et on rentre la clé de notre VM *gateway*.

Exemple, pour ma VM *web* :

benoit@web:~$ cat .ssh/authorized_keys
```
ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAINocmFh7qQnRUGPjwTPfq/No1opXGXvszIow4WtKUNh benoit
```

### Verification du SSH :

Une fois nos modifications effectuées, on peut directement se connecter sans mot de passe : 

```
benoit@gateway:~/.ssh$ ssh 10.242.0.3

Linux manager 4.19.0-13-amd64 #1 SMP Debian 4.19.160-2 (2020-11-28) x86_64

The programs included with the Debian GNU/Linux system are free software;
the exact distribution terms for each program are described in the
individual files in /usr/share/doc/*/copyright.

Debian GNU/Linux comes with ABSOLUTELY NO WARRANTY, to the extent
permitted by applicable law.
Last login: Tue Feb  2  08:39:11 2021 from 10.242.0.1

benoit@web:~$

```

