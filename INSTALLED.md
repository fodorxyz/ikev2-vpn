# Download certificate

### Linux/Mac
* `scp root@{{domain}}:/vpn-certs/server-root-ca.pem ./`

### Windows
* Use WinSCP or similar to download `/vpn-certs/server-root-ca.pem`

# Add more users

* `ssh root@{{domain}}`
* `/var/fodorxyz/ikev2-vpn/adduser username password`

# How to connect

Follow the instructions here:
https://www.digitalocean.com/community/tutorials/how-to-set-up-an-ikev2-vpn-server-with-strongswan-on-ubuntu-16-04#connecting-from-windows


# Setup on Mac

The easiest way to set this up on Mac is to download, then open, the mobile config profile: https://cloud.ashleyhindle.com/ikev2-vpn/

Then go to `System Preferences` -> `Network` -> and click the `Fodor IKEv2` connection and press `Connect`

# Setup on iOS

The easiest way to set this up on iOS is to download and install the mobile config profile: https://cloud.ashleyhindle.com/ikev2-vpn/

After it's installed go to `Settings` -> `General` -> `VPN` then choose `Fodor IKEv2` and turn the VPN on with the slider

# Setup on Ubuntu

[Follow guide here](https://wiki.strongswan.org/projects/strongswan/wiki/NetworkManager)
  
# Setup on Android

[Use this app](https://play.google.com/store/apps/details?id=org.strongswan.android&hl=en)
