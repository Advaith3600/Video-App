<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Certbot - Ubuntufocal Nginx</title>

    <script src='/js/main.js' type="text/javascript" defer="defer"></script>



    <script src='/js/instructions.js' type="text/javascript" defer="defer"></script>


</head>


<body class="instructions page">

    <h1>certbot instructions</h1>

    <div class="page-content">
        <div class="wrapper">
            <div class="instructions content">
                <h2 id="instructions-header"><a href="/lets-encrypt/ubuntufocal-nginx.html">Nginx on Ubuntu 20.04</a>
                </h2>
                <div class="instruction-pane-wrapper">
                    <div class="instruction-pane automated">
                        <ol>
                            <aside class="note">
                                <div class="note-header">
                                    <h3>Snap Support</h3>
                                </div>
                                <p>
                                    The Certbot snap supports the x86_64, ARMv7, and ARMv8 architectures.
                                    While we strongly recommend that most users install Certbot through the snap,
                                    you can find alternate installation instructions
                                    <a href="/docs/install.html">here</a>.
                                </p>
                            </aside>

                            <li>
                                SSH into the server
                                <p>SSH into the server running your HTTP website as a user with sudo privileges.</p>
                            </li>
                            <li>
                                Install snapd
                                <p>
                                    You'll need to install snapd and make sure you follow any instructions to enable
                                    classic snap support.<br />
                                    Follow these instructions on <a
                                        href="https://snapcraft.io/docs/installing-snapd/">snapcraft's site to install
                                        snapd</a>.
                                </p>
                                <p class="centered">
                                    <a class="link-button" href="https://snapcraft.io/docs/installing-snapd/">install
                                        snapd</a>
                                </p>
                            </li>
                            <li>
                                Ensure that your version of snapd is up to date
                                <p>
                                    Execute the following instructions on the command line on the machine to ensure
                                    that you have the latest version of <tt>snapd</tt>.
                                </p>
                                <pre>sudo snap install core; sudo snap refresh core</pre>
                            </li>
                            <li>
                                Remove certbot-auto and any Certbot OS packages
                                <p>
                                    If you have any Certbot packages installed using an OS package manager like
                                    <tt>apt</tt>, <tt>dnf</tt>, or <tt>yum</tt>, you should remove them before
                                    installing the Certbot snap to ensure that when you run the command
                                    <tt>certbot</tt> the snap is used rather than the installation from your OS
                                    package manager. The exact command to do this depends on your OS, but
                                    common examples are <tt>sudo apt-get remove certbot</tt>, <tt>sudo dnf
                                        remove certbot</tt>, or <tt>sudo yum remove certbot</tt>.
                                </p>
                                <p>
                                    If you previously used Certbot through the certbot-auto script, you should
                                    also remove its installation by following the instructions <a
                                        href="/docs/uninstall.html">here</a>.
                                </p>
                            </li>

                            <li>
                                Install Certbot
                                <p>
                                    Run this command on the command line on the machine to install Certbot.
                                    <pre>sudo snap install --classic certbot</pre>
                                </p>
                            </li>
                            <li>
                                Prepare the Certbot command
                                <p>
                                    Execute the following instruction on the command line on the machine to ensure
                                    that the <tt>certbot</tt> command can be run.
                                </p>
                                <pre>sudo ln -s /snap/bin/certbot /usr/bin/certbot</pre>
                            </li>



                            <li> Choose how you'd like to run Certbot
                                <ul>
                                    <li>
                                        Either get and install your certificates...
                                        <p>
                                            Run this command to get a certificate and have Certbot edit your Nginx
                                            configuration
                                            automatically to serve it, turning on HTTPS access in a single step.
                                            <pre>sudo certbot --nginx</pre>
                                        </p>
                                    </li>
                                    <li>
                                        Or, just get a certificate
                                        <p>
                                            If you're feeling more conservative and would like to make the changes to
                                            your Nginx
                                            configuration by hand, run this command.
                                            <pre>sudo certbot certonly --nginx</pre>
                                        </p>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                Test automatic renewal
                                <p>
                                    The Certbot packages on your system come with a cron job or systemd timer that will
                                    renew your certificates
                                    automatically before they expire. You will not need to run Certbot again, unless you
                                    change your
                                    configuration.</p>



                                <p>You can test automatic renewal for your certificates by running this command:
                                    <pre>sudo certbot renew --dry-run</pre>
                                </p>
                                <p>
                                    If that command completes without errors, your certificates will renew automatically
                                    in the background.
                                </p>

                            </li>

                            <li>
                                Confirm that Certbot worked
                                <p>
                                    To confirm that your site is set up properly, visit
                                    <tt>https://yourwebsite.com/</tt> in your browser and
                                    look for the lock icon in the URL bar.
                                </p>
                            </li>

                        </ol>
                    </div>

                    <div class="instruction-pane advanced">
                        <ol>
                            <aside class="note">
                                <div class="note-header">
                                    <h3>Snap Support</h3>
                                </div>
                                <p>
                                    The Certbot snap supports the x86_64, ARMv7, and ARMv8 architectures.
                                    While we strongly recommend that most users install Certbot through the snap,
                                    you can find alternate installation instructions
                                    <a href="/docs/install.html">here</a>.
                                </p>
                            </aside>
                            <li>
                                Check if your DNS provider is supported
                                <p>
                                    See if your DNS provider is supported by Certbot by checking
                                    <a href="/docs/using.html#dns-plugins">this list in our
                                        documentation</a>.
                                </p>
                                <p class="centered">
                                    <a class="link-button" href="/docs/using.html#dns-plugins">check if your DNS
                                        provider supports Certbot</a>
                                </p>
                                <h3>Not supported?</h3>
                                <p>
                                    If your DNS provider is not supported, pause here: run Certbot with the manual
                                    plugin by using
                                    <a href="/docs/using.html#manual">these steps from our documentation</a>.
                                </p>
                                <h3>Supported?</h3>
                                <p>
                                    If your DNS provider is supported, continue with the remaining instructions below.
                                </p>
                            </li>

                            <li>
                                SSH into the server
                                <p>SSH into the server running your HTTP website as a user with sudo privileges.</p>
                            </li>
                            <li>
                                Install snapd
                                <p>
                                    You'll need to install snapd and make sure you follow any instructions to enable
                                    classic snap support.<br />
                                    Follow these instructions on <a
                                        href="https://snapcraft.io/docs/installing-snapd/">snapcraft's site to install
                                        snapd</a>.
                                </p>
                                <p class="centered">
                                    <a class="link-button" href="https://snapcraft.io/docs/installing-snapd/">install
                                        snapd</a>
                                </p>
                            </li>
                            <li>
                                Ensure that your version of snapd is up to date
                                <p>
                                    Execute the following instructions on the command line on the machine to ensure
                                    that you have the latest version of <tt>snapd</tt>.
                                </p>
                                <pre>sudo snap install core; sudo snap refresh core</pre>
                            </li>
                            <li>
                                Remove certbot-auto and any Certbot OS packages
                                <p>
                                    If you have any Certbot packages installed using an OS package manager like
                                    <tt>apt</tt>, <tt>dnf</tt>, or <tt>yum</tt>, you should remove them before
                                    installing the Certbot snap to ensure that when you run the command
                                    <tt>certbot</tt> the snap is used rather than the installation from your OS
                                    package manager. The exact command to do this depends on your OS, but
                                    common examples are <tt>sudo apt-get remove certbot</tt>, <tt>sudo dnf
                                        remove certbot</tt>, or <tt>sudo yum remove certbot</tt>.
                                </p>
                                <p>
                                    If you previously used Certbot through the certbot-auto script, you should
                                    also remove its installation by following the instructions <a
                                        href="/docs/uninstall.html">here</a>.
                                </p>
                            </li>

                            <li>
                                Install Certbot
                                <p>
                                    Run this command on the command line on the machine to install Certbot.
                                    <pre>sudo snap install --classic certbot</pre>
                                </p>
                            </li>
                            <li>
                                Prepare the Certbot command
                                <p>
                                    Execute the following instruction on the command line on the machine to ensure
                                    that the <tt>certbot</tt> command can be run.
                                </p>
                                <pre>sudo ln -s /snap/bin/certbot /usr/bin/certbot</pre>
                            </li>

                            <li>
                                Confirm plugin containment level
                                <p>
                                    Run this command on the command line on the machine to acknowledge that the
                                    installed
                                    plugin will have the same <tt>classic</tt> containment as the Certbot snap.
                                </p>
                                <pre>sudo snap set certbot trust-plugin-with-root=ok</pre>

                                <p>
                                    If you encounter issues with running Certbot, you may need to follow this step, then
                                    the "Install correct DNS plugin" step, again.
                                </p>
                            </li>

                            <li>
                                Install correct DNS plugin
                                <p>
                                    Run the following command, replacing &lt;PLUGIN&gt; with the name of your DNS
                                    provider.
                                </p>
                                <pre>sudo snap install certbot-dns-&lt;PLUGIN&gt;</pre>
                                <p>
                                    For example, if your DNS provider is Cloudflare, you'd run the following command:
                                </p>
                                <pre>sudo snap install certbot-dns-cloudflare</pre>
                            </li>
                            <li>
                                Set up credentials
                                <p>
                                    You'll need to set up DNS credentials.<br />
                                    Follow the steps in the "Credentials" section for your DNS provider to access or
                                    create the
                                    appropriate credential configuration file. Find credentials instructions for your
                                    DNS provider
                                    by clicking the <a href="/docs/using.html#dns-plugins">DNS plugin's name on the
                                        Documentation list</a>.
                                </p>
                                <p class="centered">
                                    <a class="link-button" href="/docs/using.html#dns-plugins">find your DNS plugin's
                                        Credential steps</a>
                                </p>
                            </li>

                            <li> Choose how you'd like to run Certbot
                                <ul>
                                    <li>
                                        Either get and install your certificates...
                                        <p>
                                            Run one of the commands in the "Examples" section of the <a
                                                href="/docs/using.html#dns-plugins">instructions for your DNS
                                                provider</a>,
                                            along with the flag <tt>-i nginx</tt>.
                                        </p>
                                    </li>
                                    <li>
                                        Or, just get a certificate
                                        <p>
                                            Run one of the commands in the "Examples" section of the <a
                                                href="/docs/using.html#dns-plugins">instructions for your DNS
                                                provider</a>.
                                        </p>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                Test automatic renewal
                                <p>
                                    The Certbot packages on your system come with a cron job or systemd timer that will
                                    renew your certificates
                                    automatically before they expire. You will not need to run Certbot again, unless you
                                    change your
                                    configuration.</p>



                                <p>You can test automatic renewal for your certificates by running this command:
                                    <pre>sudo certbot renew --dry-run</pre>
                                </p>
                                <p>
                                    If that command completes without errors, your certificates will renew automatically
                                    in the background.
                                </p>

                            </li>

                            <li>
                                Confirm that Certbot worked
                                <p>
                                    To confirm that your site is set up properly, visit
                                    <tt>https://yourwebsite.com/</tt> in your browser and
                                    look for the lock icon in the URL bar.
                                </p>
                            </li>

                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>