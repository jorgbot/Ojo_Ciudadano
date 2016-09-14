/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

function registerPushwooshAndroid() {

    var pushNotification = cordova.require("com.pushwoosh.plugins.pushwoosh.PushNotification");

    //set push notifications handler
    document.addEventListener('push-notification',
        function (event) {
            var title = event.notification.title;
            var userData = event.notification.userdata;

            //dump custom data to the console if it exists
            if (typeof (userData) != "undefined") {
                console.warn('datos de usuario: ' + JSON.stringify(userData));
            }

            //and show alert
            console.log(title);

            //stopping geopushes
            //pushNotification.stopGeoPushes();
        }
    );

    //initialize Pushwoosh with projectid: "GOOGLE_PROJECT_ID", appid : "PUSHWOOSH_APP_ID". This will trigger all pending push notifications on start.
    pushNotification.onDeviceReady({
        projectid: "697329602980",
        appid: "DC11D-B4FF1"
    });

    //register for push notifications
    pushNotification.registerDevice(
        function (token) {
            console.log(token);
            //callback when pushwoosh is ready
            onPushwooshAndroidInitialized(token);
        },
        function (status) {
            console.log("Registro a Fallado: " + status);
            console.warn(JSON.stringify(['Registro a Fallado ', status]));
        }
    );
}

function onPushwooshAndroidInitialized(pushToken) {
    //output the token to the console
    console.warn('push token: ' + pushToken);

    var pushNotification = cordova.require("com.pushwoosh.plugins.pushwoosh.PushNotification");

    //if you need push token at a later time you can always get it from Pushwoosh plugin
    pushNotification.getPushToken(
        function (token) {
            console.warn('push token: ' + token);
        }
    );

    //and HWID if you want to communicate with Pushwoosh API
    pushNotification.getPushwooshHWID(
        function (token) {
            console.warn('Pushwoosh HWID: ' + token);
        }
    );

    pushNotification.getTags(
        function (tags) {
            console.warn('Etiqueta de Dispositivo: ' + JSON.stringify(tags));
        },
        function (error) {
            console.warn('Error al obtener etiqueta: ' + JSON.stringify(error));
        }
    );


    //set multi notificaiton mode
    pushNotification.setMultiNotificationMode();
    //pushNotification.setEnableLED(true);

    //set single notification mode
    //pushNotification.setSingleNotificationMode();

    //disable sound and vibration
    //pushNotification.setSoundType(1);
    //pushNotification.setVibrateType(1);

    pushNotification.setLightScreenOnNotification(false);

    //setting list tags
    //pushNotification.setTags({"MyTag":["hello", "world"]});

    //settings tags
    pushNotification.setTags({
            deviceName: "Hola",
            deviceId: 10
        },
        function (status) {
            console.warn('Fijado de Etiqueta Exitoso');
        },
        function (status) {
            console.warn('Fijado de Etiqueta Fallido');
        }
    );

    //Pushwoosh Android specific method that cares for the battery
    //pushNotification.startGeoPushes();
}