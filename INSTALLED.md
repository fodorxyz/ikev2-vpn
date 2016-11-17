# Setup on Mac

# Setup on iOS

```
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
    <!-- Set the name to whatever you like, it is used in the profile list on the device -->
    <key>PayloadDisplayName</key>
    <string>Profile name</string>
    <!-- This is a reverse-DNS style unique identifier used to detect duplicate profiles -->
    <key>PayloadIdentifier</key>
    <string>org.example.vpn1</string>
    <!-- A globally unique identifier, use uuidgen on Linux/Mac OS X to generate it -->
    <key>PayloadUUID</key>
    <string>9f93912b-5fd2-4455-99fd-13b9a47b4581</string>
    <key>PayloadType</key>
    <string>Configuration</string>
    <key>PayloadVersion</key>
    <integer>1</integer>
    <key>PayloadContent</key>
    <array>
        <!-- It is possible to add multiple VPN payloads with different identifiers/UUIDs and names -->
        <dict>
            <!-- This is an extension of the identifier given above -->
            <key>PayloadIdentifier</key>
            <string>org.example.vpn1.conf1</string>
            <!-- A globally unique identifier for this payload -->
            <key>PayloadUUID</key>
            <string>29e4456d-3f03-4f15-b46f-4225d89465b7</string>
            <key>PayloadType</key>
            <string>com.apple.vpn.managed</string>
            <key>PayloadVersion</key>
            <integer>1</integer>
            <!-- This is the name of the VPN connection as seen in the VPN application later -->
            <key>UserDefinedName</key>
            <string>VPN Name</string>
            <key>VPNType</key>
            <string>IKEv2</string>
            <key>IKEv2</key>
            <dict>
                <!-- Hostname or IP address of the VPN server -->
                <key>RemoteAddress</key>
                <string>vpn.example.org</string>
                <!-- Remote identity, can be a FQDN, a userFQDN, an IP or (theoretically) a certificate's subject DN. Can't be empty.
                     IMPORTANT: DNs are currently not handled correctly, they are always sent as identities of type FQDN -->
                <key>RemoteIdentifier</key>
                <string>vpn.example.org</string>
                <!-- Local IKE identity, same restrictions as above. If it is empty the client's IP address will be used -->
                <key>LocalIdentifier</key>
                <string></string>
                <!-- Optional, if it matches the CN of the root CA certificate (not the full subject DN) a certificate request will be sent
                     NOTE: If this is not configured make sure to configure leftsendcert=always on the server, otherwise it won't send its certificate -->
                <key>ServerCertificateIssuerCommonName</key>
                <string>Example Root CA</string>
                <!-- Optional, the CN or one of the subjectAltNames of the server certificate to verify it, if not set RemoteIdentifier will be used -->
                <key>ServerCertificateCommonName</key>
                <string>vpn.example.org</string>
                <!-- The server is authenticated using a certificate -->
                <key>AuthenticationMethod</key>
                <string>Certificate</string>
                <!-- The client uses EAP to authenticate -->
                <key>ExtendedAuthEnabled</key>
                <integer>1</integer>
                <!-- User name for EAP authentication. Since iOS 9 this is optional, the user is prompted when the profile is installed -->
                <key>AuthName</key>
                <string>User</string>
                <!-- Optional password for EAP authentication, if it is not set the user is prompted when the profile is installed
                <key>AuthPassword</key>
                <string>...</string>
                -->
                <!-- The next two dictionaries are optional (as are the keys in them), but it is recommended to specify them as the default is to use 3DES.
                     IMPORTANT: Because only one proposal is sent (even if nothing is configured here) it must match the server configuration -->
                <key>IKESecurityAssociationParameters</key>
                <dict>
                    <key>EncryptionAlgorithm</key>
                    <string>AES-128</string>
                    <key>IntegrityAlgorithm</key>
                    <string>SHA1-96</string>
                    <key>DiffieHellmanGroup</key>
                    <integer>14</integer>
                </dict>
                <key>ChildSecurityAssociationParameters</key>
                <dict>
                    <key>EncryptionAlgorithm</key>
                    <string>AES-128</string>
                    <key>IntegrityAlgorithm</key>
                    <string>SHA1-96</string>
                    <key>DiffieHellmanGroup</key>
                    <integer>14</integer>
                </dict>
            </dict>
        </dict>
        <!-- This payload is optional but it provides an easy way to install the CA certificate together with the configuration -->
        <dict>
            <key>PayloadIdentifier</key>
            <string>org.example.ca</string>
            <key>PayloadUUID</key>
            <string>64988b2c-33e0-4adf-a432-6fbcae543408</string>
            <key>PayloadType</key>
            <string>com.apple.security.root</string>
            <key>PayloadVersion</key>
            <integer>1</integer>
            <!-- This is the Base64 (PEM) encoded CA certificate -->
            <key>PayloadContent</key>
            <data>
            MIIDajCCA...
            </data>
        </dict>
    </array>
</dict>
</plist>
```

# Setup on Android



# Add more accounts

Instructions here - we will create a bin script so it's easy

# Ability to download profiles

# Update

This will allow you to update the ipsec/strongswan templates

* `ssh root@{DOMAIN}`
* `/var/fodorxyz/ikev2-vpn/bin/update`