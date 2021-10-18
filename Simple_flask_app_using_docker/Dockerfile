
FROM python:3.7

WORKDIR /test

COPY requirements.txt /test/requirements.txt

RUN apt-get update && \
        apt-get install -y libsm6 libxext6 libxrender-dev && \
        pip install --upgrade pip

RUN pip install -r requirements.txt

RUN apt-get update && \
     apt-get install -yq --no-install-recommends \
     libasound2 libatk1.0-0 libc6 libcairo2 libcups2 libdbus-1-3 \
     libexpat1 libfontconfig1 libgcc1 libgconf-2-4 libgdk-pixbuf2.0-0 libglib2.0-0 libgtk-3-0 libnspr4 \
     libpango-1.0-0 libpangocairo-1.0-0 libstdc++6 libx11-6 libx11-xcb1 libxcb1 \
     libxcursor1 libxdamage1 libxext6 libxfixes3 libxi6 libxrandr2 libxrender1 libxss1 libxtst6 \
     libnss3 libgl1-mesa-glx
	
	
COPY . /test
	
EXPOSE 5000

ENTRYPOINT ["python"]

CMD ["simpleapp.py"]

