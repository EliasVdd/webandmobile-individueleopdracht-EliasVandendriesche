import React from 'react';
import { Textfield, Layout, Header, HeaderRow, Navigation, Drawer, Content } from 'react-mdl';

const NavigationBar = (props) => {
    return (
        <div>
            <Layout>
                <Header>
                    <HeaderRow title="Title">
                        <Textfield
                            value="Search"
                            onChange={() => { }}
                            label="Search2"
                            expandable
                            expandableIcon="search"
                        />
                    </HeaderRow>
                </Header>
                <Drawer title="Title">
                    <Navigation>
                        <a href="#">Find by id</a>
                    </Navigation>
                </Drawer>
                <Content>
                    <div className="page-content" />
                </Content>
            </Layout>
        </div>
    );
}

export default NavigationBar;