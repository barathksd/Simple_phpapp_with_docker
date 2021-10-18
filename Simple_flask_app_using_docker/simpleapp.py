# -*- coding: utf-8 -*-
"""
Created on Wed Oct 13 13:21:12 2021

@author: Lenovo
"""

from flask import Flask, render_template, request, Response, url_for, jsonify, flash, redirect
import os
import sys
import yaml
import datetime as dtlib
from datetime import datetime
import json


def myapp():
    app = Flask(__name__)
    app.config['SECRET_KEY'] = '082d96e286cb2cd8d64fc70462466f7d'
    app.debug = True
    
    @app.route("/",methods=['GET','POST'])
    @app.route("/home",methods=['GET','POST'])
    def home():
        print('in home')
        data = None
        if request.method == 'POST':
            print('in post')
            data = request.form
            if 'name' in data.keys():
                if 'startdate' not in data.keys():
                    data['startdate'] = datetime(2021,2,1,0,0,0)
                elif 'enddate' not in data.keys():
                    data['enddata'] = data
                flash('Success','success')
                

        return render_template('index.html',title='ウォーリーを探せ！',data=data)
    
    return app

if __name__=='__main__':
    myapp().run(host='0.0.0.0',port=5000,debug=True)




