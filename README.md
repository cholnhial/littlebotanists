# Little Botanists

An educational web application for DECO1800 

## Important things

#### Windows (Editing hosts file)

1. Run notepad as Administrator
2. Open the file C:\Windows\System32\Drivers\etc\hosts (At the bottom of the file dialog choose "All Files" if you don't see hosts file)
3. Add the line `127.0.0.1       local.littlebotanists.com.au` to the bottom of the file.
4. Save and Exit

#### Mac/Linux (Editing hosts file)

1. Open your terminal
2. Use either vim or nano to edit the file `vim /etc/hosts` or `nano /etc/hosts`
3. Add the line `127.0.0.1       local.littlebotanists.com.au` to the bottom of the file.
4. Save and Exit
## Development

### Starting the development
In the root of the project, in a terminal type:

`docker-compose up -d`

This will start the docker containers the app needs to run

#### Accessing the application

Visit http://local.littlebotanists.com.au:8084/

