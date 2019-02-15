function IsIeVersion(e) {
    try {
        if (typeof e == "undefined" || e === null) return !1;
        var t = navigator.userAgent,
            n = t.indexOf("MSIE "),
            r = 0;
        if (n > 0) {
            r = parseInt(t.substring(n + 5, t.indexOf(".", n)), 10);
            if (e === r) return !0
        }
    } catch (i) {
        LogEx("wphone IsIeVersion:", i)
    }
    return !1
}

function onInit() {
    flashapi_public.onInit()
}

function onEvent(e) {
    flashapi_public.onEvent(e)
}

function onDebug(e) {
    flashapi_public.onDebug(e)
}

function onConnected(e) {
    flashapi_public.onConnected(e)
}

function onDisconnected() {
    flashapi_public.onDisconnected()
}

function onLogin(e, t, n) {
    flashapi_public.onLogin(e, t, n)
}

function onLogout(e, t) {
    flashapi_public.onLogout(e, t)
}

function onCallState(e, t) {
    flashapi_public.onCallState(e, t)
}

function onIncomingCall(e, t, n, r, i) {
    flashapi_public.onIncomingCall(e, t, n, r, i)
}

function onHangup(e, t) {
    flashapi_public.onHangup(e, t)
}

function onDisplayUpdate(e, t, n) {
    flashapi_public.onDisplayUpdate(e, t, n)
}

function onMakeCall(e, t, n) {
    flashapi_public.onMakeCall(e, t, n)
}

function onAttach(e) {
    flashapi_public.onAttach(e)
}

function webphonetojs(e) {
    try {
        webphone_public.webphone_started = !0, window.webphone_pollstatus = !1, typeof common_public != "undefined" && common_public !== null ? common_public.ReceiveNotifications(e) : alert("webphonetojs common_public is not defined")
    } catch (t) {
        typeof common_public != "undefined" && common_public !== null && common_public.PutToDebugLogException(2, "wphone webphonetojs: ", t)
    }
}
try {
    console && console.log && console.log("Loading webphone API...")
} catch (e) {}
var api_helper = function() {
    function t(t, n) {
        if (u(t) || t.length < 1) return;
        i(), u(e) && (e = []), u(n) && (n = []), n.unshift(t), n.unshift(o().toString()), e.push(n)
    }

    function i() {
        if (!u(n)) return;
        n = setInterval(function() {
            r++;
            if (u(e) || r > 5e3 && e.length < 1 && typeof plhandler != "undefined" && plhandler !== null) typeof n != "undefined" && n !== null && clearInterval(n), n = null, e = [], r = 0;
            if (typeof plhandler != "undefined" && plhandler !== null && !u(e) && e.length > 0) {
                var t = e.shift();
                if (u(t) || t.length < 2) return;
                var i = 0;
                try {
                    i = f(t[0])
                } catch (a) {}
                if (o() - i > 6e5) return;
                t.shift();
                var l = t[0];
                if (u(l) || l.length < 1) return;
                t.shift(), s(l, t)
            }
        }, 15)
    }

    function s(e, t) {
        var n = window.plhandler[e];
        if (typeof n != "function") return;
        n.apply(window, t)
    }

    function o() {
        var e = new Date;
        return typeof e != "undefine" && e !== null ? e.getTime() : 0
    }

    function u(e) {
        try {
            return typeof e == "undefined" || e === null ? !0 : !1
        } catch (t) {}
        return !0
    }

    function a(e) {
        try {
            return typeof e == "undefined" || e == null ? !1 : (e = e.toString(), e = e.replace(/\s+/g, ""), e == null || e.length < 1 ? !1 : !isNaN(e))
        } catch (t) {}
        return !1
    }

    function f(e) {
        try {
            return u(e) || !a(e) ? null : (e = l(e, " ", ""), parseInt(e, 10))
        } catch (t) {}
        return null
    }

    function l(e, t, n) {
        try {
            return u(e) || u(t) || u(n) ? "" : (e = e.toString(), e.replace(new RegExp(h(t), "g"), n))
        } catch (r) {}
        return ""
    }

    function c(e) {
        try {
            return u(e) || e.lenght < 1 ? "" : (e = e.toString(), e.replace(/^\s+|\s+$/g, ""))
        } catch (t) {}
        return e
    }

    function h(e) {
        try {
            return u(e) || e.lenght < 1 ? "" : e.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&")
        } catch (t) {}
        return ""
    }
    var e = [],
        n = null,
        r = 0,
        p = {
            AddToQueue: t,
            StrToInt: f,
            Trim: c,
            IsNumber: a,
            isNull: u
        };
    return p
}();
webphone_api.parameters.issdk = !0, webphone_api.webrtc_socket = null, webphone_api.stopengine = function(e) {
    return typeof plhandler != "undefined" && plhandler !== null ? plhandler.StopEngine(e) : ""
}, webphone_api.getlastcalldetails = function() {
    return typeof plhandler != "undefined" && plhandler !== null ? plhandler.GetLastCallDetails() : ""
}, webphone_api.isserviceinstalled = function(e) {
    if (!e || typeof e != "function") {
        webphone_api.Log("ERROR, webphone_api: isserviceinstalled callback not defined");
        return
    }
    typeof plhandler != "undefined" && plhandler !== null ? plhandler.IsServiceInstalled(e) : (webphone_api.Log("ERROR, webphone_api: isserviceinstalled plhandler is not defined"), e(!1))
}, webphone_api.GetIncomingDisplay = function() {
    return typeof plhandler != "undefined" && plhandler !== null ? plhandler.GetIncomingDisplay() : ""
}, webphone_api.HTTPKeepAlive = function() {
    typeof plhandler != "undefined" && plhandler !== null && plhandler.HTTPKeepAlive()
}, webphone_api.GetOneStunSrv = function() {
    return typeof plhandler != "undefined" && plhandler !== null ? plhandler.GetOneStunSrv() : ""
}, webphone_api.InsertApplet = function(e) {
    typeof plhandler == "undefined" || plhandler === null ? api_helper.AddToQueue("InsertApplet", [e]) : plhandler.InsertApplet(e)
}, webphone_api.RecEvt = function(e) {
    if (!webphone_api.evcb || typeof webphone_api.evcb != "function") return;
    webphone_api.evcb(e)
}, webphone_api.onLoadedCb = function() {
    if (!webphone_api.loadedcb || typeof webphone_api.loadedcb != "function") return;
    webphone_api.loadedcb()
}, webphone_api.onStartCb = function() {
    if (!webphone_api.startcb || typeof webphone_api.startcb != "function") return;
    webphone_api.startcb()
}, webphone_api.onRegisteredCb = function() {
    if (!webphone_api.registeredcb || typeof webphone_api.registeredcb != "function") return;
    webphone_api.registeredcb()
}, webphone_api.onUnRegisteredCb = function() {
    if (!webphone_api.unregisteredcb || typeof webphone_api.unregisteredcb != "function") return;
    webphone_api.unregisteredcb()
}, webphone_api.onCallStateChangeCb = function(e, t, n) {
    if (!webphone_api.callstatechangecb || typeof webphone_api.callstatechangecb != "function") return;
    webphone_api.callstatechangecb(e, t, n)
}, webphone_api.onChatCb = function(e, t) {
    if (!webphone_api.chatcb || typeof webphone_api.chatcb != "function") return;
    webphone_api.chatcb(e, t)
}, webphone_api.onCdrCb = function(e, t, n, r) {
    if (!webphone_api.cdrcb || typeof webphone_api.cdrcb != "function") return;
    webphone_api.cdrcb(e, t, n, r)
}, webphone_api.onLogCb = function(e) {
    if (!webphone_api.logcb || typeof webphone_api.logcb != "function") return;
    webphone_api.logcb(e)
};
var dnotcb = null;
webphone_api.GetDisplayableNotifications = function(e) {
    if (!e || typeof e != "function") return;
    dnotcb = e
}, webphone_api.RecDisplayableNotifications = function(e) {
    if (!dnotcb || typeof dnotcb != "function") return;
    dnotcb(e)
}, webphone_api.enterkeypress = function() {
    typeof plhandler != "undefined" && plhandler !== null ? plhandler.EnterKeyPress() : webphone_api.Log("ERROR, webphone_api: enterkeypress plhandler is not defined")
}, webphone_api.filetransfercallback = function(e) {
    typeof plhandler != "undefined" && plhandler !== null ? plhandler.FileTransferCallback(e) : webphone_api.Log("ERROR, webphone_api: filetransfercallback plhandler is not defined")
}, webphone_api.bwanswer = function(e) {
    typeof plhandler != "undefined" && plhandler !== null ? plhandler.bwanswer(e) : webphone_api.Log("ERROR, webphone_api: bwanswer plhandler is not defined")
}, webphone_api.onappexit = function() {
    typeof plhandler != "undefined" && plhandler !== null ? plhandler.onappexit() : webphone_api.Log("ERROR, webphone_api: onappexit plhandler is not defined")
}, webphone_api.needratingrequest = function(e) {
    typeof plhandler != "undefined" && plhandler !== null ? plhandler.needratingrequest(e) : webphone_api.Log("ERROR, webphone_api: needratingrequest plhandler is not defined")
}, webphone_api.helpwindow = function() {
    typeof plhandler != "undefined" && plhandler !== null ? plhandler.HelpWindow() : webphone_api.Log("ERROR, webphone_api: helpwindow plhandler is not defined")
}, webphone_api.settingspage = function() {
    typeof plhandler != "undefined" && plhandler !== null ? plhandler.SettingsPage() : webphone_api.Log("ERROR, webphone_api: settingspage plhandler is not defined")
}, webphone_api.dialpage = function() {
    typeof plhandler != "undefined" && plhandler !== null ? plhandler.DialPage() : webphone_api.Log("ERROR, webphone_api: dialpage plhandler is not defined")
}, webphone_api.messageinboxpage = function() {
    typeof plhandler != "undefined" && plhandler !== null ? plhandler.MessageInboxPage() : webphone_api.Log("ERROR, webphone_api: messageinboxpage plhandler is not defined")
}, webphone_api.messagepage = function() {
    typeof plhandler != "undefined" && plhandler !== null ? plhandler.MessagePage() : webphone_api.Log("ERROR, webphone_api: messagepage plhandler is not defined")
}, webphone_api.addcontact = function() {
    typeof plhandler != "undefined" && plhandler !== null ? plhandler.AddContact() : webphone_api.Log("ERROR, webphone_api: addcontact plhandler is not defined")
}, webphone_api.unregisterWebrtc = function() {
    typeof plhandler != "undefined" && plhandler !== null && plhandler.UnregisterWebrtc()
}, webphone_api.GetBrowser = function() {
    try {
        var e = null,
            t = null,
            n = navigator.userAgent.toLowerCase();
        n.indexOf("edge") !== -1 ? (e = "Edge", t = "Edge") : n.indexOf("msie") !== -1 && n.indexOf("opera") === -1 ? (e = "MSIE", t = "MSIE") : n.indexOf("trident") !== -1 || n.indexOf("Trident") !== -1 ? (e = "MSIE", t = "MSIE") : n.indexOf("iphone") !== -1 ? (e = "Netscape Family", t = "iPhone") : n.indexOf("firefox") !== -1 && n.indexOf("opera") === -1 ? (e = "Netscape Family", t = "Firefox") : n.indexOf("chrome") !== -1 ? (e = "Netscape Family", t = "Chrome") : n.indexOf("safari") !== -1 ? (e = "Netscape Family", t = "Safari") : n.indexOf("mozilla") !== -1 && n.indexOf("opera") === -1 ? (e = "Netscape Family", t = "Other") : n.indexOf("opera") !== -1 ? (e = "Netscape Family", t = "Opera") : (e = "?", t = "unknown")
    } catch (r) {
        webphone_api.LogEx("wphone: GetBrowser", r)
    }
    return t
}, webphone_api.GetBrowserVersion = function() {
    try {
        var e = -1,
            t = webphone_api.GetBrowser(),
            n = navigator.userAgent.toLowerCase();
        if (t === "Chrome") {
            var r = n.indexOf("chrome");
            r > 0 && (n = n.substring(r + 6)), n != null && (n = n.replace("/", "")), r = n.indexOf("."), r > 0 && (n = n.substring(0, r)), n != null && (n = api_helper.Trim(n), api_helper.IsNumber(n) && (e = api_helper.StrToInt(n)))
        }
    } catch (i) {
        webphone_api.LogEx("wphone: GetBrowserversion", i)
    }
    return e
}, webphone_api.SupportHtml5 = function() {
    try {
        return !!document.createElement("canvas").getContext
    } catch (e) {
        webphone_api.LogEx("wphone: SupportHtml5", e)
    }
    return !1
}, webphone_api.API_SetParameter = function(e, t) {
    return webphone_api.setparameter(e, t)
}, webphone_api.API_SetCredentials = function(e, t, n, r, i) {
    return plhandler.API_SetCredentials(e, t, n, r, i)
}, webphone_api.API_SetCredentialsMD5 = function(e, t, n, r) {
    return plhandler.API_SetCredentialsMD5(e, t, n, r)
}, webphone_api.API_Start = function() {
    return webphone_api.start()
}, webphone_api.API_StartStack = function() {
    return webphone_api.start()
}, webphone_api.API_Register = function(e, t, n, r, i) {
    return webphone_api.setparameter("serveraddress", e), webphone_api.setparameter("sipusername", t), webphone_api.setparameter("password", n), webphone_api.setparameter("displayname", i), webphone_api.start()
}, webphone_api.API_Unregister = function() {
    return webphone_api.unregister()
}, webphone_api.API_CheckVoicemail = function(e) {
    return plhandler.API_CheckVoicemail(e)
}, webphone_api.API_SetLine = function(e) {
    return plhandler.API_SetLine(e)
}, webphone_api.API_GetLine = function() {
    return plhandler.API_GetLine(line)
}, webphone_api.API_GetLineStatus = function(e) {
    return plhandler.API_GetLineStatus(e)
}, webphone_api.API_Call = function(e, t) {
    return webphone_api.call(t)
}, webphone_api.API_CallEx = function(e, t, n) {
    return webphone_api.API_Call(e, t, 0)
}, webphone_api.API_Hangup = function(e, t) {
    return webphone_api.hangup()
}, webphone_api.API_Accept = function(e) {
    return webphone_api.accept()
}, webphone_api.API_Reject = function(e) {
    return webphone_api.reject()
}, webphone_api.API_Forward = function(e, t) {
    return plhandler.API_Forward(e, t)
}, webphone_api.API_Transfer = function(e, t) {
    return webphone_api.transfer(t)
}, webphone_api.API_MuteEx = function(e, t, n) {
    return webphone_api.mute(t, n)
}, webphone_api.API_IsMuted = function(e) {
    return plhandler.API_IsMuted(e)
}, webphone_api.API_IsOnHold = function(e) {
    return plhandler.API_IsOnHold(e)
}, webphone_api.API_Hold = function(e, t) {
    return webphone_api.hold(t)
}, webphone_api.API_Conf = function(e) {
    return webphone_api.conference(e)
}, webphone_api.API_Dtmf = function(e, t) {
    return webphone_api.dtmf(t)
}, webphone_api.API_SendChat = function(e, t, n) {
    return webphone_api.sendchat(t, n)
}, webphone_api.API_AudioDevice = function() {
    return webphone_api.audiodevice()
}, webphone_api.API_SetVolume = function(e, t) {
    return webphone_api.setvolume(e, t)
}, webphone_api.API_GetAudioDeviceList = function(e) {
    return plhandler.API_GetAudioDeviceList(e)
}, webphone_api.API_GetAudioDevice = function(e) {
    return plhandler.API_GetAudioDevice(e)
}, webphone_api.API_SetAudioDevice = function(e, t, n) {
    return plhandler.API_SetAudioDevice(e)
}, webphone_api.API_GetVolume = function(e) {
    return plhandler.API_GetVolume(e)
}, webphone_api.LogEx = function(e, t) {
    if (api_helper.isNull(e)) return;
    api_helper.isNull(t) || (e = "ERROR," + e + " " + t), webphone_api.Log(e)
}, webphone_api.Log = function(e) {
    if (api_helper.isNull(e) || e.length < 1) return;
    console && console.log && (console.error && e.toLowerCase().indexOf("error") > -1 ? console.error(e) : console.log(e))
};
var isie8iframe = !1;
try {
    IsIeVersion(8) && window.self !== window.top && (isie8iframe = !0)
} catch (err) {}
if (IsIeVersion(6) || IsIeVersion(7) || isie8iframe) window.location.href = "oldieskin/wphone.htm";
document.write('<link rel="stylesheet" href="css/pmodal.css" />'), document.write('<script type="text/javascript" src="../../public/js/lib/picoModal.js"></script>'), (webphone_api.GetBrowser() !== "Chrome" || webphone_api.GetBrowser() === "Chrome" && webphone_api.GetBrowserVersion() < 42) && document.write('<script type="text/javascript" src="../../public/js/lib/mwpdeploy.js"></script>'), document.write('<script data-main="js/lib/lib_softphone" src="../../public/js/lib/require.js"></script>');