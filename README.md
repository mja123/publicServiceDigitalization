# Create a virtual environment named venv on Windows
python -m venv venv 
# Activate the environment
my_project\Scripts\activate

# Create a virtual environment named venv on Linux
python3 -m venv venv 
# Activate the environment on Linux/macOS
source my_project/bin/activate


## Install dependencies
pip install -r requirements.txt


## Run 
fastapi dev src/app.py