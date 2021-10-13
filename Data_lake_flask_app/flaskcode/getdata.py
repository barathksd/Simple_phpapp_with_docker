# -*- coding: utf-8 -*-
"""
Created on Thu Mar  4 10:31:24 2021

@author: 81807
"""

from flask import Flask, render_template, request, Response
import os
import sys
import yaml
import numpy as np
import json 
import cv2
import io
import json
import pymysql
import pymysql.cursors
import time
from datetime import datetime
import requests
import traceback


def execsql(sqlcmd,database='activestreamhcx',cmd=None):
 
    connection = pymysql.connect(host='mysql',
                                     port=3306,
                                     user='root',
                                     password='sqlpass',
                                     database=database,
                                     cursorclass=pymysql.cursors.DictCursor)

    with connection.cursor() as cursor:
        #sqlcmd = "SELECT * from aicamera_log"
        result = None
        cursor.execute(sqlcmd)
        if cmd == 'select_1':
            result = cursor.fetchone()
            
        elif cmd == 'selectall':
            result = cursor.fetchall()
            
    connection.commit()
    connection.close()
    # connection is not autocommit by default. So you must commit to save
    # your changes.
    return result


def myapp():
    app = Flask(__name__)
    app.debug = True
    
    @app.route("/",methods=['POST','GET'])
    def hello():
        if request.method == 'POST':
            d= request.json
            sqlcmd = 'INSERT INTO xylog (UTC,UTCMs,camNo,personID,personName,matchScore,matchThreshold,age,gender,x,y,rx,ry) VALUES ("{}","{}","{}",{},"{}",{},{},{},"{}",{},{},{},{});'.format(d['UTC'],d['UTCMs'],d['camNo'],d['personID'],d['personName'],d['matchScore'],d['matchThreshold'],d['Age'],d['Sex'],d['x'],d['y'],d['rx'],d['ry'])
            try:
                #with open("d.txt", "w") as txtfile:
                #    txtfile.write(str(d)+str(type(d))+'\n'+sqlcmd)
                execsql(sqlcmd)
                
            except Exception as e:
                with open('error.txt',"w") as txtfile:
                    txtfile.write(str(e)+' - '+str(traceback.format_exc()))

            return Response(status=200)
        return "Test Ok"
    
    
    @app.route("/update",methods=['POST','GET'])
    def update():
        if request.method == 'POST':
            data = request.json

            if isinstance(data,dict):
                data = [data]
            for d in data:
                sqlcmd = 'SELECT uid,rx,ry FROM xylog WHERE UTC="{}" AND UTCMs="{}" AND camNo="{}" AND personName="{}"'.format(d['UTC'],d['UTCMs'],d['camNo'],d['pid'])

                try:
                    result = execsql(sqlcmd,cmd='select_1')
                    if isinstance(result,dict) and (result['rx'] != d['rx'] or result['ry'] != d['ry']):
                        sqlcmd = 'UPDATE xylog SET rx={}, ry={} WHERE uid={}'.format(d['rx'],d['ry'],result['uid'])
                    elif result is None:
                        sqlcmd = 'INSERT INTO xylog (UTC,UTCMs,camNo,personID,personName,matchScore,matchThreshold,age,gender,x,y,rx,ry) VALUES ("{}","{}","{}",{},"{}",{},{},{},"{}",{},{},{},{});'.format(d['UTC'],d['UTCMs'],d['camNo'],0,d['pid'],0,0,0,'',d['x'],d['y'],d['rx'],d['ry'])
            
                    execsql(sqlcmd)
                    
                except Exception as e:
                    with open('error.txt',"w") as txtfile:
                        txtfile.write(str(e)+' - '+str(traceback.format_exc()))
                    return Response(status=500)
            return Response(status=200)
                     
    return app
    
if __name__=='__main__':
    myapp().run(debug=True)