<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Message;
use App\User;

class MessageController extends Controller
{
    /**
     * Show the application inbox message.
     *
     * @return \Illuminate\Http\Response
     */

    public function inbox()
    {
        return view('inbox', [
            'newmessages' => Message::where("to", strtolower(Auth::user()->name))->where('read', 0)->orderBy('id', 'desc')->get(),
            'oldmessages' => Message::where("to", strtolower(Auth::user()->name))->where('read', 1)->orderBy('id', 'desc')->get(),
            'user' => Auth::user()
        ]);
    }

    public function viewMessage($m)
    {
        $message = Message::where("id", $m)->get()->first();

        if (strtolower($message->to) != strtolower(Auth::user()->name))
            return redirect('inbox');

        $message->read = 1;
        $message->save();
        return view('message', [
            'm' => $message,
        ]);
    }

    public function newMessage()
    {
        return view('newmessage', [
            'name' => "",
            'user' => Auth::user()
        ]);
    }

    public function newTargetMessage($name)
    {
        return view('newmessage', [
            'name' => $name,
            'user' => Auth::user()
        ]);
    }

    public static function sendSystemMessage($username, $title, $message)
    {
        $message = Message::create([
            'to' => strtolower($username),
            'from' => "",
            'title' => $title,
            'text' => $message,
            'sentat' => date("d-m-y H:i")

        ]);
        $message->save();
    }

    public function sendMessage(Request $request)
    {
        $to = $request['to'];
        $from = Auth::user()->name;
        $title = $request['title'];
        $text = $request['text'];

        //checking if the user we are sending the message to exists.
        if (count(User::where("name", strtolower($to))->get()) == 0) {
            return redirect('newmessage')->with('fail', '"' . $to . '" is not a valid user.');
        }

        if ($title == null || $title == "") {
            return redirect('newmessage')->with('fail', 'Please enter a title.');
        }

        if ($text == null || $text == "") {
            return redirect('newmessage')->with('fail', 'Why would you send an empty message?');
        }

        if ($to == Auth::user()->name) {
            return redirect('newmessage')->with('fail', 'Why would you send a message to yourself?');
        }

        $this->validate($request, [
            'title' => 'Required|max:400',
            'text' => 'Required|max:64'
        ]);

        $message = Message::create([
            'to' => strtolower($to),
            'from' => $from,
            'title' => $title,
            'text' => $text,
            'sentat' => date("d-m-y H:i")

        ]);
        $message->save();


        return redirect('inbox')->with('success', 'Message sent.');
    }

    public function sendGlobalMessage(Request $request)
    {
        $from = Auth::user()->name;
        $title = $request['title'];
        $text = $request['text'];

        if (Auth::user()->globalmsg < 1) {
            return redirect("newglobalmessage")->
            with("fail", "You need at least 1 global message point to send a global message.");
        }

        if ($title == null || $title == "") {
            return redirect('newglobalmessage')->with('fail', 'Please enter a title.');
        }

        if ($text == null || $text == "") {
            return redirect('newglobalmessage')->with('fail', 'Why would you send an empty message?');
        }

        $this->validate($request, [
            'title' => 'Required|max:400',
            'text' => 'Required|max:64'
        ]);

        $users = User::all();
        foreach($users as $user) {
            if ($user->name != $from)
            Message::create([
                'to' => strtolower($user->name),
                'from' => $from,
                'title' => $title,
                'text' => $text,
                'sentat' => date("d-m-y H:i")

            ]);
        }
        Auth::user()->globalmsg -=1;
        Auth::user()->save();
        return redirect('inbox')->with('success', 'Global message sent.');
    }

    public function deleteMessage(Request $request)
    {
        $id = $request['id'];

        if (count(Message::where('id', $id)->get()) == 0) {
            return redirect('inbox')->with('fail', 'That message has already been deleted!');
        }

        $message = Message::where('id', $id)->get()->first();
        $message->delete();
        return redirect('inbox')->with('success', 'Message deleted.');
    }

    public function deleteAllMessages(Request $request)
    {

        $messages = Message::where("to", strtolower(Auth::user()->name))->get();

        foreach ($messages as $message)
            $message->delete();

        return redirect('inbox')->with('success', 'All messages deleted.');
    }

    public function readAllMessages(Request $request)
    {

        $messages = Message::where("to", strtolower(Auth::user()->name))->get();

        foreach ($messages as $message) {
            $message->read = 1;
            $message->save();
        }

        return redirect('inbox')->with('success', 'All messages marked as read.');
    }

    /**
     * Show the application send new global message.
     *
     * @return \Illuminate\Http\Response
     */
    public function newGlobalMessage()
    {
        return view('newglobalmessage', array("user" => Auth::user()));
    }
}
