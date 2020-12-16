import React, { useCallback, useState } from "react";
import {
  Button,
  TextField,
  Checkbox,
  Form,
  FormLayout
} from "@shopify/polaris";
import { Redirect} from '@shopify/app-bridge/actions';
import { Context } from '@shopify/app-bridge-react';



export default function FormOnSubmitExample() {
  const [email, setDate] = useState("");
  const [date, setTime] = useState("");
  const app = Context;
  

  const handleSubmit = useCallback((_event) => {
    setDate("");
    setTime("");
    redirectToHome();
  }, []);
  const redirectToHome = () => {
    const redirect = Redirect.create(app);
    redirect.dispatch(
      Redirect.Action.APP,
      '/',
    );
  };

  const handleDateChange = useCallback((value) => setDate(value), []);
  const handleTimeChange = useCallback((value) => setTime(value), []);
  return (
    <Form onSubmit={handleSubmit}>
      <FormLayout>
        <TextField
          value={email}
          onChange={handleDateChange}
          label="Date"
          type="date"
        />
        <TextField
          value={date}
          onChange={handleTimeChange}
          label="Time"
          type="time"
        />

        <Button submit>Submit</Button>
      </FormLayout>
    </Form>
  );
}