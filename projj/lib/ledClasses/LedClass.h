#ifndef LedClass_h
#define LedClass_h

#include <Arduino.h>
#include <Toggelable.h>

class LedClass : public Togglable
{
private:
    byte pin;
    byte buttonPin; // it is optional to use
    boolean state;
    boolean hasbutton;
    bool btnprevstate;// to toggle the led using button
    bool btncurstate;// to toggle the led using button
    unsigned long previous;  // for button debounce (has nothing to do with the timer)
    unsigned long duration;  // for timer (how many seconds to toggle)
    unsigned long startTime; // when i sat the timer

public:
    LedClass(byte pin)
    {
        hasbutton = false;
        this->pin = pin;
        state = LOW;
        previous = 0UL;
        duration = 0UL;
        startTime = 0UL;
        btncurstate = HIGH;
        btnprevstate = HIGH;
        buttonPin = -1;
    }

    LedClass(byte pin, byte buttonPin) : LedClass(pin)
    { // i called the first constructor
        setButton(buttonPin);
    }

    virtual void init()
    {
        if (hasButton())
        {
            pinMode(buttonPin, INPUT_PULLUP);
        }
        pinMode(pin, OUTPUT);
    }
    virtual void init(byte defaultState)
    {
        init();
        if (defaultState == HIGH)
        {
            on();
        }
        else
        {
            off();
        }
    }

    virtual void on() override
    {
        digitalWrite(pin, HIGH);
        state = HIGH;
    }
    virtual void off() override
    {
        digitalWrite(pin, LOW);
        state = LOW;
    }

    virtual bool isOn()
    {
        return (state == HIGH);
    }

    virtual void toggle() override // you can just digialWrite(pin,!digitalRead(pin)); but this is better
    {
        if (isOn())
        {
            off();
        }
        else
        {
            on();
        }
    }

    virtual void setButton(int i)
    {
        hasbutton = true;
        buttonPin = i;
    }

    virtual byte btn()
    {
        return buttonPin;
    }

    virtual bool hasButton()
    {
        return hasbutton;
    }
    virtual boolean checkIfNo() const // this function to let the invoker know that is not instance from NoRgb
    {
        return false;
    }
    virtual unsigned long getStartTime()
    {
        return startTime;
    }
    virtual void setStartTime(unsigned long s)
    {
        startTime = s;
    }
    virtual unsigned long getPrevious()
    {
        return previous;
    }
    virtual void setPrevious(unsigned long s)
    {
        previous = s;
    }
    virtual unsigned long getDuration()
    {
        return duration;
    }
    virtual void setDuration(unsigned long s)
    {
        duration = s;
    }

    virtual bool btnstate()
    {
        return digitalRead(buttonPin);
    }

    virtual boolean getBtnprevstate()
    {
        return btnprevstate;
    }
    virtual void setBtnprevstate(boolean s)
    {
        btnprevstate = s;
    }
    virtual boolean getBtncurvstate()
    {
        return btncurstate;
    }
    virtual void setBtncurstate(boolean s)
    {
        btncurstate = s;
    }
};

#endif
